<?php

namespace App\Http\Controllers\BackEnd\Post;

use App\Http\Controllers\BaseController;
use App\Http\Enum\filterEnum;
use App\Http\Service\Media\UploadMediaService;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->model = new Post();
        $this->upload = new UploadMediaService();
        $this->dir = __DIR__;
        $this->setNameBreadcrumb('Bài viết');
        $this->seo()->setTitle('Quản lý bài viết');
        SEOMeta::setKeywords('Bài viết');
    }

    function _columns_table(&$tpl) {
        $lsTh = [
            ['key' => 'name', 'name' => 'Tên bài viết', 'td'=> ['class' => 'text-center text-success']],
            ['key' => 'name', 'name' => 'Danh mục', 'td'=> ['class' => 'text-center'] , 'relation' => 'category'],
            ['key' => 'name', 'name' => 'Tác giả' , 'td'=> ['class' => 'text-center'],  'relation' => 'user'],
            ['key' => 'status', 'name' => 'Trạng thái', 'td'=> ['class' => 'text-center']],
            ['key' => 'created_at', 'name' => 'Ngày tạo', 'td'=> ['class' => 'text-center']],
        ];
        $tpl['lsTh'] = $lsTh;
    }

    public function columns(&$arr)
    {
        $user = User::query()->where('status', BaseModel::getStatusActive())->get(['id', 'name'])->toArray();
        $arr = [
            ['name' => 'created_by', 'type' => filterEnum::FILTER_SELECT, 'placeholder' => 'Vui lòng nhập tác giả', 'value' => $user],
            ['name' => 'category', 'type' => filterEnum::FILTER_SEARCH, 'placeholder' => 'Vui lòng nhập danh mục'],
        ];
    }

    function after_input(&$tpl) {
        $tpl['status'] = BaseModel::getStatus();
        $category = Category::getInstance()->active()->where('type', Category::get_type_new())->get(['id', 'name']);
        $tpl['category'] = $category;
        $tpl['all_tag'] = Category::getInstance()->active()->where('type', Category::get_type_tag())->get(['id', 'name']);;
        if(@$tpl['obj']['tags']) {
            $tags = json_decode($tpl['obj']['tags']);
            if($tags) {
                $tpl['tag'] = array_flip($tags);
            }
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
        if (check_request_field($request, 'created_by')) {
            $query = where_like($query, 'created_by', $request->get('created_by'));
        }
    }


    function validate_ajax($request) {  // chưa validate tags
        $slug = Str::slug($request->get('name'));
        $request->offsetSet('slug', $slug);
        $rules = [
            'name' => 'required|string',
            'images' => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            'content' => 'required|string',
            'description' => 'required|string',
            'status' => ['required','string', function ($attribute, $value, $fail) {
                $status = BaseModel::getStatus($value, true);
                if($status['id'] === -13) {
                    return $fail('Trạng thái không hợp lệ');
                }
            }],
            'slug' => ['required','string', function ($attribute, $value, $fail) use($request) {
                $check_slug = $this->model->where('slug', $value);
                if($request->get('id')) {
                    $check_slug = $check_slug->where('id', '<>', $request->get('id'));
                }
                $check_slug = $check_slug->count();
                if($check_slug) {
                    return $fail('Tiêu đề bài viết đã tồn tại');
                }
            }],
        ];
        if(!$request->get('draft')) {
            unset($rules['images']);
            $rules['images_c'] = 'required|string';
        }

        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'string' => ':attribute hợp lệ',
            'numeric' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
        ], [
            'name' => 'Tên bài viết',
            'images' => 'Ảnh đại diện',
            'images_c' => 'Ảnh đại diện',
            'slug' => 'Bài viết',
            'category_id' => 'Danh mục',
            'description' => 'Mô tả ngẵn',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'tags' => 'Tags',
        ]);
    }




    function before_save(&$model, $request) {
        $model->name = $request->get('name');
        $model->slug = $request->get('slug');
        $model->status = $request->get('status', 0);
        $model->category_id = $request->get('category_id');
        $model->description = $request->get('description');
        $model->content = $request->get('content');
        $model->created_by = @auth()->id();
        if($request->get('draft')) {
            $model->type = 0;
        }else{
            $model->type = 1;
        }
        if($request->get('tags')) {
            $model->tags = json_encode($request->get('tags'));
        }
        if($request->get('images_c')) {
            $model->avatar = $request->get('images_c');
        }
        if ($request->file('images')){
            $images = $this->upload->upload('images', true);
            $model->avatar = $images['media']['relative_link'];
        }

        $seo = [];
        if($request->get('seo_images_c')) {
            $seo['images'] = $request->get('seo_images_c');
        }

        if ($request->file('seo_images')){
            $images = $this->upload->upload('seo_images', true);
            $seo['images'] = $images['media']['relative_link'];
        }

        if ($request->get('seo_keyword')){
            $seo['keyword'] = $request->get('seo_keyword');
        }

        if ($request->get('seo_keyword_extra')){
            $seo['keyword_extra'] = $request->get('seo_keyword_extra');
        }


        if ($request->get('seo_title')){
            $seo['title'] = $request->get('seo_title');
        }

        if ($request->get('seo_description')){
            $seo['description'] = $request->get('seo_description');
        }

        if ($request->get('seo_type')){
            $seo['type'] = $request->get('seo_type');
        }

        if ($request->get('seo_url')){
            $seo['url'] = $request->get('seo_url');
        }

        if ($request->get('seo_url_canonical')){
            $seo['url_canonical'] = $request->get('seo_url_canonical');
        }

        if($seo) {
            $model->seo = json_encode($seo);
        }
    }

    function result_response(&$result, $model) {
        $result['redirect'] = route('post', ['cmd' => 'input', 'id' => $model->id]);
    }
}