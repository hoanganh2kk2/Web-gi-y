<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App\Hps\eJson;
use App\Hps\eView;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Models\BaseModel;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\City;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ProductModel;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends FrontEndController
{
    public function __construct()
    {
        $this->model = new Cart();
        $this->dir = __DIR__;
    }

    function list(Request $request){
        $tpl = [];
        return eView::getInstance()->notfoundClient();
    }

    function ajax_add_to_cart(Request $request) {
        $tpl = [];
        $productId = $request->get('id');
        $quantity = $request->get('quantity');
        if(!$productId) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin sản phẩm');
        }
        if(!$quantity) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin số lượng sản phẩm');
        }
        $product = ProductModel::query()->where('id', $productId)->active()->typeOfficial()->first();
        if(!$product) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin sản phẩm');
        }
        $customer = auth()->id();
        if(!$customer) {
            eJson::getInstance()->getJsonError('Thất bại');
        }
        $cart = $this->model->where('customer_id', $customer)->first();
        begin_transaction();
        try {
            $cart_id = 0;
            if(!$cart) {
                // ko tồn tại thì tạo mới
                $inset_cart = [
                    'customer_id' => $customer,
                    'status' => BaseModel::getStatusActive(),
                    'type' => 1,
                    'created_at' => time(),
                    'created_by' => $customer,
                    'sku' => 'cart-'.generate_product_code(),
                ];
                $cart_id = $this->model->newQuery()->insertGetId($inset_cart);
            }
            if(!$cart_id) {
                $cart_id = $cart['id'];
            }
            // inset vào cart_item
            // check xem đã tồn tại giỏ hay chưa và trong giỏ hàng có sp đó hay chưa ?
            $cart_item = CartItem::query()->where('cart_id', $cart_id)->where('product_id', $productId)->first();
            if(!$cart_item || $cart_item['value'] != $product['sell_price']) {
                // không tồn tại sp trong cart_item => tạo mới
                $inset_cart_item = [
                    'cart_id' => $cart_id,
                    'quantity' => $quantity,
                    'product_id' => $productId,
                    'value' => $product['sell_price'],
                    'total' => $product['sell_price'] * $quantity,
                    'product_name' => $product['name'],
                    'product_sku' => $product['sku'],
                    'product_avatar' => $product['avatar'],
                    'product_slug' => $product['slug'],
                ];
                CartItem::query()->insertGetId($inset_cart_item);
            }else{
                // có rồi thì + thêm số lượng
                $quantity = $cart_item['quantity'] + $quantity;
                $cart_item['quantity'] = $quantity;
                $cart_item['total'] = $cart_item['value'] * $quantity;
                $cart_item->save();
            }
            $cartItem = CartItem::query()->where('cart_id', $cart_id)->get();
            $tpl['cartItem'] = $cartItem;
            $tpl['count'] = $cartItem->count();
            transaction_commit();
            eJson::getInstance()->getJsonSuccess('Thêm sản phẩm vào giỏ hàng thành công', $tpl);
        }catch (\Exception $e) {
            transaction_roll_back();
            eJson::getInstance()->getJsonError('Thất bại');
        }
    }


    function ajax_clear_cart(Request $request) {
        $cartItemId = $request->get('id');
        if(!$cartItemId) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $cartItem = CartItem::query()->find($cartItemId);
        if(!$cartItem) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $cartItem->delete();
        eJson::getInstance()->getJsonSuccess('Xoá sản phẩm khỏi giỏ hàng thành công');
    }

    function ajax_clear_quantiti_cart(Request $request) {
        $tpl = [];
        $cartItemId = $request->get('id');
        if(!$cartItemId) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $cartItem = CartItem::query()->find($cartItemId);
        if(!$cartItem) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $quantity = $cartItem['quantity'] - 1;
        if($quantity < 1) {
            $cartItem->delete();
        }else{
            $cartItem['quantity'] = $quantity;
            $cartItem['total'] =  $cartItem['value'] * $quantity;
            $cartItem->save();
        }
        $tpl['count'] = $quantity;
        eJson::getInstance()->getJsonSuccess('Xoá sản phẩm khỏi giỏ hàng thành công', $tpl);
    }

    function ajax_add_quantity_to_cart(Request $request) {
        $tpl = [];
        $cartItemId = $request->get('id');
        if(!$cartItemId) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $cartItem = CartItem::query()->find($cartItemId);
        if(!$cartItem) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin');
        }
        $quantity = $cartItem['quantity'] + 1;
        $cartItem['quantity'] = $quantity;
        $cartItem['total'] =  $cartItem['value'] * $quantity;
        $cartItem->save();
        $tpl['count'] = $quantity;
        eJson::getInstance()->getJsonSuccess('Thêm sản phẩm vào giỏ hàng thành công', $tpl);
    }

    function get_cart(Request $request) {
        $this->seo()->setTitle('Giỏ hàng');
        SEOMeta::setKeywords('cart');
        $this->seo()->setDescription('Giỏ hàng (Shopping Cart) là một chức năng quan trọng trong các trang web bán hàng trực tuyến. Khi khách hàng tìm thấy các sản phẩm mà họ muốn mua, họ có thể thêm chúng vào giỏ hàng để tạm lưu lại và chuyển đến trang thanh toán sau này.');
        $tpl = [];
        $schema =[
            'type' => 'Cart',
            'name' => 'Giỏ hàng',
            'description' => 'Giỏ hàng của bạn',
            'url' => route('fe.cart', ['cmd' => 'get_cart']),
        ];
        $schema = setSchema($schema);
        $customer = auth()->id();
        $cart = $this->model->newQuery()->where('customer_id',$customer)->first();
        if(!$cart) {
            return eView::getInstance()->notfoundClient();
        }
        $cartId = $cart['id'];
        $cartItem = CartItem::query()->where('cart_id', $cartId)->get();
        if(!$cartItem->count()) {
            return eView::getInstance()->notfoundClient();
        }
        $customer = auth()->user()->load('city', 'districts', 'ward');
        $tpl['customer'] = $customer;
        $tpl['cities'] = City::all();
        $tpl['carts'] = $cartItem;
        $tpl['schema'] = $schema;
        return eView::getInstance()->setView($this->dir, 'cart', $tpl);
    }

    function create_order(Request $request) {
        set_request();
        $this->validate_order($request);
        $customerId = auth()->id();
        $cart = $this->model->newQuery()->where('customer_id', $customerId)->first();
        if(!$cart) {
            return eView::getInstance()->notfoundClient();
        }
        $cartItem = CartItem::query()->where('cart_id', $cart['id'])->get();
        if(!$cartItem) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin sản phẩm trong giỏ hàng của bạn');
        }
        // tạo đơn hàng
        try {
            begin_transaction();
            // tạo order
            $order = [
              'customer_id' => $customerId,
              'sku' => 'orders-'.generate_product_code(),
              'total' => $cartItem->sum('total'),
              'customer_name' => $request->get('customer_name'),
              'customer_email' => $request->get('customer_email'),
              'customer_phone' => $request->get('customer_phone'),
              'address' => $request->get('address'),
              'city_id' => $request->get('city'),
              'districts_id' => $request->get('districts'),
              'ward_id' => $request->get('ward'),
              'status' => Orders::getInstance()->getStatusPending(),
              'created_at' => time(),
            ];
            $orderId = Orders::query()->insertGetId($order);
            // tạo order item
            foreach ($cartItem as $item) {
                $orderItem = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'value' => $item['value'],
                    'total' => $item['total'],
                    'product_name' => $item['product_name'],
                    'product_sku' => $item['product_sku'],
                    'product_avatar' => $item['product_avatar'],
                    'product_slug' => $item['product_slug'],
                    'order_id' => $orderId,
                ];
                OrderItem::query()->insert($orderItem);
                $item->delete(); // xoá cartItem
            }
            $cart->delete(); // xoá cart
            transaction_commit();
            $result['redirect'] = route('fe.home');
            eJson::getInstance()->getJsonSuccess('Tạo đơn hàng thành công. Vui lòng liên hệ quản trị viên để được nhận hàng sớm nhất.', $result);
        }catch (\Exception $e) {
            transaction_roll_back();
            dd($e);
            eJson::getInstance()->getJsonError('Thất bại');
        }
    }


    function validate_order($request) {
        $rules = [
            'customer_name' => 'required|string',
            'customer_email' => 'required|string|email',
            'city' => 'required|numeric|exists:__cities,id',
            'districts' => 'required|numeric|exists:__districts,id',
            'ward' => 'required|numeric|exists:__wards,id',
            'address' => 'required|string',
            'customer_phone' => ['required', 'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/i'],
        ];

        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'email' => ':attribute không hợp lệ',
            'regex' => ':attribute không hợp lệ',
            'string' => ':attribute không hợp lệ',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 3 kí tự',
        ], [
            'customer_email' => 'Email',
            'customer_phone' => 'Số điện thoại',
            'customer_name' => 'Tên khách hàng',
            'city' => 'Tỉnh/Thành phố',
            'districts' => 'Quận/Huyện',
            'ward' => 'Xã/Phường',
            'address' => 'Địa chỉ chi tiết',
        ]);
    }



}