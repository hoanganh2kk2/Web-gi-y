<?php

namespace App\Http\Controllers;


use App\Hps\eHelper;
use App\Hps\eJson;
use App\Hps\eLogs;
use App\Hps\eView;
use App\Http\Enum\filterEnum;
use App\Http\Enum\LogEnum;
use App\Models\BaseModel;
use App\Models\Districts;
use App\Models\Log;
use App\Models\Wards;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseController extends Controller
{
    protected $model;
    protected $upload;
    protected $log = true;
    protected $dir = __DIR__;
    protected $response;
    use SEOTools;

    public function index($action = '')
    {
        $action = str_replace('-', '_', $action);

        if (method_exists($this, $action)) {
            return $this->$action(request());
        } else {
            return $this->list(request());
        }
    }

    function list(Request $request)
    {
        $tpl = [];
        $this->_columns_table($tpl);
        $model = $this->model;
        $count = $request->get('count', 50);
        $sort = $request->get('sort', 'DESC');
        $this->_columns_filter($tpl);
        $this->_query_filter($model, $request);
        $model = $model->orderBy('id', $sort);
        $tpl['lsObj'] = $model->paginate($count);
        return eView::getInstance()->setView('', 'base.list', $tpl);
    }

    function _columns_table(&$tpl) {

    }

    function _columns_filter(&$tpl) {
        $sorts = [
            ['name' => 'Z - A', 'id' => 'DESC', 'selected' => true],
            ['name' => 'A - Z', 'id' => 'ASC'],
        ];
        $columns = [
            ['name' => 'name', 'type' => filterEnum::FILTER_SEARCH, 'placeholder' => 'Vui lòng nhập tên'],
        ];
        $this->columns($arr);
        foreach ($arr as $item){
            $columns[] = $item;
        }
        $columns[] = ['name' => 'status', 'type' => filterEnum::FILTER_SELECT, 'placeholder' => 'Chọn trạng thái', 'value' => BaseModel::getStatus()];
        $this->unset_column($columns);
        $tpl['columns'] = $columns;
        $tpl['sorts'] = $sorts;
    }

    function columns(&$arr)
    {
        $arr = [];
    }

    function unset_column(&$columns)
    {

    }

    function _query_filter(&$model, Request $request) {  // viết with ở đây luôn

    }

    function input(Request $request)
    {
        $tpl = [];
        $id = $request->get('id');
        $obj = $this->model::query();
        $this->add_query($obj);
        $obj = $obj->find($id);
        if (!empty($id) && !$obj) {
            return eView::getInstance()->notfound($id);
        }
        $tpl['obj'] = $obj;
        $seo_title = $id ? 'Cập nhật thông tin "'. $obj['name'] ?? $obj['id'] .'"' : 'Thêm mới';
        $this->seo()->setTitle($seo_title);
        $this->after_input($tpl);
        if($this->log && $id) {
           $this->get_log($id, $tpl);
        }
        return eView::getInstance()->setView($this->dir, 'input', $tpl);
    }



    function get_log($id, &$tpl) {
        $tpl['logs'] = Log::getInstance()->where('object_id', $id)->where('table', $this->model->getTable())->get();
    }

    public function setNameBreadcrumb(string $name): string
    {
        return view()->share('breadcrumb', $name);
    }

    public function after_input(&$tpl)
    {

    }
    public function add_query(&$obj)
    {

    }

   function ajax_save(Request $request) {
        set_request();

        $id = $request->get('id');
        $result = [];
        if($id){
            $token = request('token');
            if (!$token) {
                eJson::getInstance()->getJsonError('Không tìm thấy thông tin token.');
            }
            $check_token = validate_token($token);
            if (!$check_token) {
                eJson::getInstance()->getJsonError('Token không hợp lệ');
            }
        }
        try {
            if(!$request->get('draft')) {
                $this->validate_ajax($request);
            }
            $id = $request->get('id'); // nếu validate_ajax cần set lại id thì thêm vào đây
            begin_transaction();
            $model = $this->model->find($id);
            $type = LogEnum::UPDATED;
            if (!$model) {
                $model = $this->model;
                $model->created_at = time();
                $type = LogEnum::CREATED;
            }
            $this->before_save($model, $request);
            $beforeModel = $model->getOriginal();
            if (!$model->isDirty()) {
                eJson::getInstance()->getJsonError('Dữ liệu chưa thay đổi');
            }else {
                $model->updated_at = time();
                $model->save();
                $this->after_save($model);
                eLogs::getInstance()->create($model->id, $type, $this->model->getTable(),$model->toArray(),  $beforeModel, $model->toArray());
                $this->result_response($result , $model);
                transaction_commit();
                eJson::getInstance()->getJsonSuccess('Lưu thông tin thành công', $result);
            }
        }catch (\Exception $e) {
            transaction_roll_back();
            eJson::getInstance()->getJsonError($e->getMessage());
        }


    }

    function after_save($model)
    {

    }

    function result_response(&$result, $model)
    {

    }

    function validate_ajax(Request $request)
    {

    }

    function before_save(&$objModel, Request $request)
    {

    }


    function deleted()
    {
        $id = request('id');
        if (!$id) {
            return abort('404');
        }
        $token = request('token');
        if (!$token) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin token.');
        }
        $check_token = validate_token($token);
        if (!$check_token) {
            eJson::getInstance()->getJsonError('Token không hợp lệ');
        }
        try {
            begin_transaction();
            $model = $this->model->where('id', $id);
            $model = $model->first();
            if (!$model) {
                eJson::getInstance()->getJsonError('Bản ghi này không tồn tại.');
            }
            if (isset($model['status']['id']) && $model['status']['id'] === BaseModel::getStatusDeleted()) {
                eJson::getInstance()->getJsonError('Bản ghi này đã bị xóa trước đó.');
            }
            $beforeModel = $model->getOriginal();
            $model->delete();
            $this->afterDelete($model);
            transaction_commit();
            eLogs::getInstance()->create($id, LogEnum::DELETED, $this->model->getTable(),$model->toArray(), $beforeModel, []);
            eJson::getInstance()->getJsonSuccess('Xóa bản ghi thành công');
        }catch (\Exception $e) {
            transaction_roll_back();
            eJson::getInstance()->getJsonError('Thất bại');
        }
    }

    function btn_add($type = true) {  // tắt bật button thêm mới
        return view()->share('btn_add', $type);
    }

    function afterDelete($model) {

    }


   function ajax_load_district(Request $request) {
        $city_id = (int)$request->get('city_id');
        if(!$city_id) {
            eJson::getInstance()->getJsonError('Vui lòng lựa chọn thông tin');
        }
        $districts = Districts::getInstance()->where('city_id', $city_id)->get(['id', 'name', 'city_id']);
        if($districts->isEmpty()) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin quận/huyện phù hợp.');
        }
        eJson::getInstance()->getJsonSuccess('Lấy danh sách thành công', $districts);
    }

   function ajax_load_ward(Request $request) {
        $district_id = (int)$request->get('district_id');
        if(!$district_id) {
            eJson::getInstance()->getJsonError('Vui lòng lựa chọn thông tin');
        }
        $ward = Wards::getInstance()->where('district_id', $district_id)->get(['id', 'name', 'district_id']);
        if($ward->isEmpty()) {
            eJson::getInstance()->getJsonError('Không tìm thấy thông tin quận/huyện phù hợp.');
        }
        eJson::getInstance()->getJsonSuccess('Lấy danh sách thành công', $ward);
    }

    function get_log_detal(Request $request)
    {
        $tpl = [];
        $id = $request->get('id');
        $log = Log::getInstance()->find($id);
        $tpl['log'] = $log;
        return view('components.log-detal', $tpl);
    }

    /**
     * @throws \Exception
     */

    function validates($request, $rules, $msg = [], $attr = []): bool
    {
        $validator =  Validator::make($request->all(), $rules, $msg, $attr);
        if ($validator->fails()) {
           eJson::getInstance()->getJsonError($validator->errors()->first());
        }
        return true;
    }


}
