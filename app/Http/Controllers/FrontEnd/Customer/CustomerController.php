<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Hps\eView;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Models\BaseModel;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends FrontEndController
{
    public function __construct()
    {
        $this->model = new Customer();
        $this->dir = __DIR__;
    }

    function list(Request $request){
        $tpl = [];
        $customer = auth()->user()->load('city', 'districts', 'ward');
        $tpl['customer'] = $customer;
        $tpl['cities'] = City::all();
        $schema =[
            'type' => 'Statics',
            'name' => 'Danh sách trang tĩnh',
            'description' => 'Đây là trang quản trị khách hàng. Nơi đây là nơi thao tác các nghiệp vụ liên quan đến cá nhân.',
            'url' => route('fe.customer')
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        return eView::getInstance()->setView($this->dir, 'customer', $tpl);
    }

    function validate_ajax($request) {
        $rules = [];
        if($request->get('change_pass')) {
            $rules['password'] = 'required|min:3';
            $rules['password_new'] = ['required','min:3', function($attribute, $value, $fail) use($request){
                if($value != $request->get('password')) {
                    return $fail('Mật khẩu nhập lại không khớp.');
                }
            }];
        }else {
            $rules = [
                'name' => 'required|string',
                'city' => 'required|numeric|exists:__cities,id',
                'districts' => 'required|numeric|exists:__districts,id',
                'ward' => 'required|numeric|exists:__wards,id',
                'address' => 'required|string',
                'status' => ['nullable', 'string', function ($attribute, $value, $fail) {
                    $status = BaseModel::getStatus($value, true);
                    if ($status['id'] === -13) {
                        return $fail('Trạng thái không hợp lệ');
                    }
                }],
                'phone' => ['required', 'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/i'],
            ];
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
            'phone' => 'Số điện thoại',
            'name' => 'Tên khách hàng',
            'city' => 'Tỉnh/Thành phố',
            'districts' => 'Quận/Huyện',
            'status' => 'Trạng thái',
            'address' => 'Địa chỉ chi tiết',
            'ward' => 'Xã/Phường',
            'password' => 'Mật Khẩu'
        ]);
    }


    function before_save(&$model, $request) {
        if($request->get('password')) {
            $model->password = Hash::make($request->get('password'));
        }else {
            $model->name = $request->get('name');
            $model->phone = $request->get('phone');
            $model->city_id = $request->get('city');
            $model->district_id = $request->get('districts');
            $model->ward_id = $request->get('ward');
            $model->address = $request->get('address');
            $model->status = 1;
        }
    }

    function result_response(&$result, $model) {
        $result['reload'] = true;
    }


    function ajax_show_form_change_password() {
        $tpl = [];
        return eView::getInstance()->setView($this->dir, 'include.resetpass', $tpl);
    }


}