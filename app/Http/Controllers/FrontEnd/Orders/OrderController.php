<?php

namespace App\Http\Controllers\FrontEnd\Orders;

use App\Hps\eJson;
use App\Hps\eView;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Enum\filterEnum;
use App\Models\OrderItem;
use App\Models\Orders;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class OrderController extends FrontEndController
{
    public function __construct()
    {
        $this->model = new Orders();
        $this->dir = __DIR__;
        $this->seo()->setTitle('Quản lý đơn hàng');
        SEOMeta::setKeywords('đơn hàng');
    }

    function list(Request $request)
    {
        $auth_id = auth()->user()->id;
        $tpl = [];
        $schema =[
            'type' => 'HomePage',
            'name' => 'Trang chủ',
            'description' => 'Đây là nơi quản lý các đơn hàng của khách hàng đã đặt',
            'url' => route('fe.orders')
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        $model = $this->model->where('customer_id',$auth_id);
        $count = $request->get('count', 50);
        $sort = $request->get('sort', 'DESC');
        $model = $model->orderBy('id', $sort);
        $tpl['lsObj'] = $model->paginate($count);
        return eView::getInstance()->setView($this->dir, 'list', $tpl);
    }

    function ajax_load_detail(Request $request) {
        $id = $request->get('id');
        $tpl = [];
        if(!$id) {
            eJson::getInstance()->getJsonError('Thất bại');
        }else{
            $orderItem = OrderItem::query()->where('order_id', $id)->get();
            if($orderItem->isEmpty()) {
                eJson::getInstance()->getJsonError('Thất bại');
            }else{
                $tpl['orderItem'] = $orderItem;
                return eView::getInstance()->setView($this->dir, 'include.detail', $tpl);
            }
        }
    }


}