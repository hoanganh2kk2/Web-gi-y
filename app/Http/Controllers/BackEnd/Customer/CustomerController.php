<?php

namespace App\Http\Controllers\BackEnd\Customer;

use App\Http\Controllers\BaseController;
use App\Http\Enum\filterEnum;
use App\Models\BaseModel;
use App\Models\City;
use App\Models\Customer;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends BaseController
{
    public function __construct()
    {
        $this->model = new Customer();
        $this->dir = __DIR__;
        $this->setNameBreadcrumb('Khách hàng');
        $this->seo()->setTitle('Quản lý khách hàng');
        SEOMeta::setKeywords('Khách hàng');
    }

    function _columns_table(&$tpl) {
        $lsTh = [
            ['key' => 'name', 'name' => 'Tên khách hàng', 'td'=> ['class' => 'text-center text-success']],
            ['key' => 'email', 'name' => 'Email', 'td'=> ['class' => 'text-center']],
            ['key' => 'phone', 'name' => 'Số điện thoại' , 'td'=> ['class' => 'text-center']],
            ['key' => 'status', 'name' => 'Trạng thái', 'td'=> ['class' => 'text-center']],
            ['key' => 'created_at', 'name' => 'Ngày tạo', 'date' => true,  'td'=> ['class' => 'text-center']],
        ];
        $tpl['lsTh'] = $lsTh;
    }


    function _query_filter(&$query, Request $request) {
        if (check_request_field($request, 'status')) {
            $query = $query->where('status', $request->get('status'));
        }

        if (check_request_field($request, 'email')) {
            $query = $query->where('email', $request->get('email'));
        }

        if (check_request_field($request, 'phone')) {
            $query = $query->where('phone', $request->get('phone'));
        }

        if (check_request_field($request, 'name')) {
            $query = where_like($query,'name', $request->get('name'));
        }
    }

    public function columns(&$arr)
    {
        $arr = [
            ['name' => 'phone', 'type' => filterEnum::FILTER_SEARCH, 'placeholder' => 'Vui lòng nhập số điện thoại'],
            ['name' => 'email', 'type' => filterEnum::FILTER_SEARCH, 'placeholder' => 'Vui lòng nhập email/tài khoản'],
        ];
    }

    function after_input(&$tpl) {
        $tpl['cities'] = City::all();
        $tpl['status'] = BaseModel::getStatus();
    }

    function add_query(&$obj)
    {
        $obj->with('city', 'districts', 'ward');
    }



    function validate_ajax($request) {
        $rules = [
            'name' => 'required|string',
            'city' => 'required|numeric|exists:__cities,id',
            'districts' => 'required|numeric|exists:__districts,id',
            'ward' => 'required|numeric|exists:__wards,id',
            'address' => 'required|string',
            'status' => ['nullable','string', function ($attribute, $value, $fail) {
                $status = BaseModel::getStatus($value, true);
                if($status['id'] === -13) {
                    return $fail('Trạng thái không hợp lệ');
                }
            }],
            'phone' => ['required', 'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/i'],
        ];
        if(!$request->get('id')) {
            $rules['email'] = 'required|email|min:3|max:64|unique:users,email';
            $rules['password'] = 'required|min:3';
        }
        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'email' => ':attribute hợp lệ',
            'regex' => ':attribute hợp lệ',
            'unique' => ':attribute đã tồn tại',
            'string' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 3 kí tự',
        ], [
            'email' => 'Tài khoản khách hàng',
            'phone' => 'Số điện thoại',
            'name' => 'Tên nhân viên',
            'city' => 'Tỉnh/Thành phố',
            'districts' => 'Quận/Huyện',
            'status' => 'Trạng thái',
            'address' => 'Địa chỉ chi tiết',
            'ward' => 'Xã/Phường',
            'password' => 'Mật Khẩu'
        ]);
    }


    function before_save(&$model, $request) {
        if(!$request->get('id')) {
            $model->email = $request->get('email');
        }
        if($request->get('password')) {
            $model->password = Hash::make($request->get('password'));
        }

        $model->name = $request->get('name');
        $model->phone = $request->get('phone');
        $model->city_id = $request->get('city');
        $model->district_id = $request->get('districts');
        $model->ward_id = $request->get('ward');
        $model->address = $request->get('address');
        $model->status = $request->get('status', 0);
    }

    function result_response(&$result, $model) {
        $result['redirect'] = route('customer', ['cmd' => 'input', 'id' => $model->id]);
    }


}