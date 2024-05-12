<?php

namespace App\Http\Controllers\BackEnd\Menu;

use App\Hps\eJson;
use App\Hps\eView;
use App\Http\Controllers\BaseController;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Statics;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends BaseController
{
    public function __construct()  // làm nhanh làm tạm thế đã hơi phèn
    {
        $this->model = new Menu();
        $this->dir = __DIR__;
        $this->setNameBreadcrumb('Menu');
        $this->seo()->setTitle('Quản lý menu');
        SEOMeta::setKeywords('Menu');
    }

    function list(Request $request)
    {
        $tpl = [];
        $model = $this->model;
        $count = $request->get('count', 50);
        $sort = $request->get('sort', 'DESC');
        $this->_query_filter($model, $request);
        $model = $model->orderBy('id', $sort);
        $tpl['lsObj'] = $model->paginate($count);
        return eView::getInstance()->setView($this->dir, 'list', $tpl);
    }

    function after_input(&$tpl) {
        $tpl['status'] = BaseModel::getStatus();
        $tpl['type'] = $this->model->getType();
        $tpl['apply'] = $this->model->getApply();
    }

    function add_query(&$obj)
    {
        $obj->with(['parent', 'apply_rele']);
    }

    function ajax_get_menu(Request $request) {
        $type = $request->get('type');
        $menu = $this->model->where('status', BaseModel::getStatusActive())->where('parent_id', 0)->where('type', $type)->get(['id', 'name', 'parent_id']);
        eJson::getInstance()->getJsonSuccess('Lấy danh sách menu thành công', $menu);
    }

    function ajax_detail(Request $request) {
        $apply = $request->get('apply');
        $value = [];
        if($apply == $this->model->getCategoryPost()) {
            $value = Category::getInstance()->where('type', Category::get_type_new())->active()->get();
        }elseif ($apply == $this->model->getCategoryProduct()){
            $value = Category::getInstance()->where('type', Category::get_type_product())->active()->get();
        }elseif($apply == $this->model->getStaticPage()){
            $value = Category::getInstance()->where('type', Category::get_type_static_page())->active()->get();
        }
        eJson::getInstance()->getJsonSuccess('Lấy danh sách thành công', $value);
    }

    function ajax_post_detail(Request $request) {
        $category_id = $request->get('category_id');
        $post = Statics::getInstance()->where('category_id', $category_id)->active()->get(['id', 'name']);
        eJson::getInstance()->getJsonSuccess('Lấy danh sách thành công', $post);
    }

    function validate_ajax($request) {
        $slug = Str::slug($request->get('name'));
        $request->offsetSet('slug', $slug);
        $rules = [
            'name' => 'required|string',
            'parent_id' => 'nullable|numeric|exists:menu,id',
            'apply_detail' => 'nullable|numeric|exists:categories,id',
            'post_detail' => 'nullable|numeric|',
            'link' => 'nullable|string|',
            'status' => ['required','numeric', function ($attribute, $value, $fail) {
                $status = BaseModel::getStatus($value, true);
                if($status['id'] === -13) {
                    return $fail('Trạng thái không hợp lệ');
                }
            }],
            'apply' => ['nullable','numeric', function ($attribute, $value, $fail) {
                $status = $this->model->getApply($value, true);
                if($status['id'] === -13) {
                    return $fail('Đối tượng áp dụng không hợp lệ');
                }
            }],
            'type' => ['required','numeric', function ($attribute, $value, $fail) {
                $status = $this->model->getType($value, true);
                if($status['id'] === -13) {
                    return $fail('Loại danh mục không hợp lệ');
                }
            }],
            'slug' => ['required','string', function ($attribute, $value, $fail) use($request) {
                $check_slug = $this->model->where('slug', $value);
                if($request->get('id')) {
                    $check_slug = $check_slug->where('id', '<>', $request->get('id'));
                }
                $check_slug = $check_slug->count();
                if($check_slug) {
                    return $fail('Menu đã tồn tại');
                }
            }],
        ];
        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'string' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
        ], [
            'name' => 'Tên menu',
            'post_detail' => 'Bài viết áp dụng',
            'type' => 'Loại Menu',
            'status' => 'Trạng thái',
            'parent_id' => 'Menucha',
            'apply' => 'Đối tượng áp dụng',
            'apply_detail' => 'Chi tiết áp dụng',
            'link' => 'Link áp dụng',
            'slug' => 'Menu',
        ]);
    }


    function before_save(&$model, $request) {
        $model->name = $request->get('name');
        $model->type = $request->get('type');
        $model->slug = $request->get('slug');
        $model->status = $request->get('status', 0);
        $model->relative_link = $request->get('link');
        $model->parent_id = 0;
        if($request->get('parent_id')) {
            $model->parent_id = $request->get('parent_id');
        }
        $model->apply = $request->get('apply');
        $model->apply_detail = $request->get('apply_detail');
        if($request->get('post_detail')) {
            $model->post_static_id = $request->get('post_detail');
        }
    }

    function result_response(&$result, $model) {
        $result['redirect'] = route('menu', ['cmd' => 'input', 'id' => $model->id]);
    }






}