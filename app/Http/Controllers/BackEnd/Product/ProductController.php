<?php

namespace App\Http\Controllers\BackEnd\Product;

use App\Hps\eJson;
use App\Http\Controllers\BaseController;
use App\Http\Service\Media\UploadMediaService;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\ProductModel as THIS;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function __construct()
    {

        $this->model = new THIS();
        $this->upload = new UploadMediaService();
        $this->setNameBreadcrumb('Sản phẩm');
        $this->dir = __DIR__;
        $this->seo()->setTitle('Quản lý sản phẩm');
        SEOMeta::setKeywords('Sản phẩm');
    }

    function _columns_table(&$tpl)
    {
        $lsTh = [
            ['key' => 'avatar', 'name' => 'Hình ảnh', 'img' => true,'td' => ['class' => 'text-center']],
            ['key' => 'name', 'name' => 'Tên Sản phẩm', 'td' => ['class' => 'text-center text-success']],
            ['key' => 'price', 'name' => 'Giá bán', 'td' => ['class' => 'text-center']],
            ['key' => 'status', 'name' => 'Trạng thái', 'td' => ['class' => 'text-center']],
            ['key' => 'created_at', 'name' => 'Ngày tạo', 'td' => ['class' => 'text-center']],
        ];
        $tpl['lsTh'] = $lsTh;
    }

    function after_input(&$tpl) {
        $tpl['status'] = BaseModel::getStatus();
        $tpl['categories'] = Category::query()->typeProduct()->get()->toArray();
        $tpl['size'] = Category::query()->Size()->get()->toArray();
        $tpl['tag'] = Category::query()->Tag()->get()->toArray();
        $tpl['color'] = Category::query()->Color()->get()->toArray();

        if(@$tpl['obj']['category_id']) {
            $cates = json_decode($tpl['obj']['category_id']);
            if($cates) {
                if(is_array($cates)) {
                    $tpl['cate'] = array_flip($cates);
                }
            }
        }

        if(@$tpl['obj']['color_id']) {
            $tpl['colors'] = $tpl['obj']['color_id'];
        }
        if(@$tpl['obj']['size_id']) {
            $tpl['sizes'] = $tpl['obj']['size_id'];
        }


    }

    function _query_filter(&$query, Request $request)
    {
        if (check_request_field($request, 'type')) {
            $query = $query->where('type', $request->get('type'));
        }
        if (check_request_field($request, 'status')) {
            $query = $query->where('status', $request->get('status', 0));
        }
        if (check_request_field($request, 'name')) {
            $query = where_like($query, 'name', $request->get('name'));
        }
    }


    function validate_ajax($request) {
        $slug = Str::slug($request->get('name'));
        $request->offsetSet('slug', $slug);
        $rules = [
            'name' => 'required|string',
            'price' => ['nullable', 'numeric',  function ($attribute, $value, $fail) use($request){
                 if($value < 0) {
                     return $fail('Giá gốc sản phẩm không hợp lệ');
                 }
            }],
            'sell_price' => ['required', 'numeric',  function ($attribute, $value, $fail) use($request){
                if($value < 0) {
                    return $fail('Giá bán sản phẩm không hợp lệ');
                }
            }],
            'description' => 'nullable|string',
            'category' => 'nullable|required',
            'slug' => ['required','string', function ($attribute, $value, $fail) use($request) {
                $check_slug = $this->model->where('slug', $value);
                if($request->get('id')) {
                    $check_slug = $check_slug->where('id', '<>', $request->get('id'));
                }
                $check_slug = $check_slug->count();
                if($check_slug) {
                    return $fail('Sản phẩm đã tổn tại');
                }
            }],
        ];
        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'string' => ':attribute hợp lệ',
            'numeric' => ':attribute không đúng định dạng',
            'exists' => ':attribute không tồn tại',
        ], [
            'name' => 'Tên sản phẩm',
            'status' => 'Trạng thái',
            'price' => 'Giá bán',
            'sell_price' => 'Giá niêm yết',
            'slug' => 'Đường dẫn',
            'description' => 'Mô tả',
            'images' => 'Hình ảnh',

        ]);
    }


    function before_save(&$model, $request) {
        $model->name = $request->get('name');
        $model->status = $request->get('status', 0);
        $model->price = (int)$request->get('price');
        $model->sell_price = (int)$request->get('sell_price');
        $model->slug = Str::slug($request->get('name'));
        $model->description = $request->get('description');
        $model->publisher = $request->get('publisher');
        $model->quantity = $request->get('quantity');
        if($request->get('draft')) {
            $model->type = 0;
        }else{
            $model->type = 1;
        }
        if(!$request->get('id')) {
            $model->sku = generate_product_code();
        }

        if($request->get('brief')) {
            $model->brief = $request->get('brief');
        }
        if($request->get('category')) {
            $model->category_id = json_encode($request->get('category'));
        }
        if($request->get('size')) {
            $model->size_id = json_encode($request->get('size'));
        }
        if($request->get('color')) {
            $model->color_id = json_encode($request->get('color'));
        }
        if($request->get('check_off')) {
            $model->check_off = 1;
        }else{
            $model->check_off = 0;
        }
        if ($request->get('media')){
            $model->media =  json_encode($request->get('media'));
        }

        if ($request->file('images')){
            $images = $this->upload->upload('images', true);
            $model->avatar = $images['media']['relative_link'];
        }
    }

    function result_response(&$result, $model) {
        $result['redirect'] = route('products', ['cmd' => 'input', 'id' => $model->id]);
    }



}