<?php

namespace App\Http\Controllers\BackEnd\Categories;

use App\Hps\eJson;
use App\Http\Controllers\BaseController;
use App\Http\Enum\filterEnum;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends BaseController
{
    public function __construct()
    {
        $this->model = new Category();
        $this->setNameBreadcrumb('Danh mục');
        $this->dir = __DIR__;
        $this->seo()->setTitle('Quản lý danh mục');
    }

    function _columns_table(&$tpl)
    {
        $lsTh = [
            ['key' => 'name', 'name' => 'Tên danh mục', 'td' => ['class' => 'text-center text-success']],
            ['key' => 'name', 'name' => 'Danh mục cha', 'td' => ['class' => 'text-center'], 'relation' => 'parent'],
            ['key' => 'type', 'name' => 'Loại danh mục', 'td' => ['class' => 'text-center']],
            ['key' => 'status', 'name' => 'Trạng thái', 'td' => ['class' => 'text-center']],
            ['key' => 'created_at', 'name' => 'Ngày tạo', 'td' => ['class' => 'text-center']],
        ];
        $tpl['lsTh'] = $lsTh;
    }


    function after_input(&$tpl) {
        $tpl['status'] = BaseModel::getStatus();
        $tpl['types'] = $this->model->getType();
    }

    function add_query(&$obj)
    {
        $obj->with('parent');
    }

    function ajax_load_parent(Request $request) {
        $type = (int)$request->get('type');
        $id = (int)$request->get('id');
        if(!$type) {
            eJson::getInstance()->getJsonError('Vui lòng lựa chọn thông tin');
        }
        $type = $this->model->where('type', $type)->active()->where('parent_id', 0);
        if($id) {
            $type = $type->where('id', '<>', $id);
        }
        $type = $type->get(['id', 'name']);
        eJson::getInstance()->getJsonSuccess('Lấy danh sách thành công', $type);
    }

    function _query_filter(&$query, Request $request)
    {
        if (check_request_field($request, 'status')) {
            $query = $query->where('status', $request->get('status', 0));
        }

        if (check_request_field($request, 'type')) {
            $query = $query->where('type', $request->get('type'));
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
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'status' => ['required','string', function ($attribute, $value, $fail) {
                $status = BaseModel::getStatus($value, true);
                if($status['id'] === -13) {
                    return $fail('Trạng thái không hợp lệ');
                }
            }],
            'type' => ['required','string', function ($attribute, $value, $fail) {
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
                    return $fail('Danh mục đã tổn tại');
                }
            }],
        ];
        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'string' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
        ], [
            'name' => 'Tên danh mục',
            'slug' => 'Danh mục',
            'type' => 'Loại danh mục',
            'status' => 'Trạng thái',
            'parent_id' => 'Danh mục cha',
        ]);
    }


    function before_save(&$model, $request) {

        $model->name = $request->get('name');
        $model->slug = Str::slug($request->get('name'));
        $model->status = $request->get('status', 0);
        $model->type = $request->get('type');
        $model->parent_id = 0;
        if($request->get('parent_id')) {
            $model->parent_id = $request->get('parent_id');
        }
    }

    function result_response(&$result, $model) {
        $result['redirect'] = route('categories', ['cmd' => 'input', 'id' => $model->id]);
    }

    public function columns(&$arr)
    {
        $user = User::query()->where('status', BaseModel::getStatusActive())->get(['id', 'name'])->toArray();
        $categories = $this->model->getType();
        $arr = [
            ['name' => 'type', 'type' => filterEnum::FILTER_SELECT, 'placeholder' => 'Loại danh mục', 'value' => $categories],
            ['name' => 'created_by', 'type' => filterEnum::FILTER_SELECT, 'placeholder' => 'Tạo bởi', 'value' => $user],
            ['name' => 'created_at', 'type' => filterEnum::FILTER_DATE, 'placeholder' => 'Vui lòng nhập ngày tạo'],
        ];
    }



}