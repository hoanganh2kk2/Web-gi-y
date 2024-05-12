<?php

namespace App\Http\Controllers\FrontEnd\Product;


use App\Hps\eJson;
use App\Hps\eView;
use App\Http\Controllers\FrontEnd\Categories\CategoriesController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Models\Comment;
use App\Models\ProductModel;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ProductController extends FrontEndController
{
    public function __construct()
    {
        $this->model = new ProductModel();
        $this->dir = __DIR__;
        $this->setNameBreadcrumb('Sản phẩm');
    }


    public function index($action = '')
    {
        if (method_exists($this, $action)) {
            return $this->$action(request());
        } else {
            $slug = str_replace('.html', '', $action);
            return $this->detail($slug);
        }
    }

    function detail($slug){
        $tpl = [];
        $product = $this->model->newQuery()->where('slug', $slug)->active()->typeOfficial()->first();
        if(!$product) {
           return eView::getInstance()->notfoundClient();
        }else{
            app(CategoriesController::class)->set_cate($tpl);
            $seo = $product['seo'];
            set_seo($seo);
            $this->seo()->addImages(show_img(@$product['avatar']));
            $comments = Comment::query()->where('product_id', $product['id'])->get();$a =$product->size_id;
            $star = 0;
            foreach ($comments as $comment){
                $star =  $star + $comment['star'];
            }
            if($comments->count()){
                $star = $star / $comments->count();
            }
            else{
                $star = 5;
            }
            $lsProduct = $this->model->newQuery()->where('slug', '<>',$slug )->active()->typeOfficial()->take(4)->get();
            $tpl['product'] = $product;
            $tpl['lsProduct'] = $lsProduct;
            $tpl['comments'] = $comments;
            $tpl['star'] = $star;
            $schema =[
                'type' => 'Post',
                'name' => $product['name'],
                'description' => @$seo->description,
                'url' => get_link_product($product['slug']),
                'image' => show_img($product['avatar'])
            ];
            $schema = setSchema($schema);
            $tpl['schema'] = $schema;
            return eView::getInstance()->setView($this->dir, 'detail', $tpl);
        }
    }



    function ajax_load_detail(Request $request) {
        $id = $request->get('id');
        $tpl = [];
        if(!$id) {
            eJson::getInstance()->getJsonError('Thất bại');
        }else{
            $product = $this->model->query()->where('id', $id)->active()->typeOfficial()->first();
            if(!$product) {
                eJson::getInstance()->getJsonError('Thất bại');
            }else{
                $tpl['product'] = $product;
                return eView::getInstance()->setView($this->dir, 'include.product-detail', $tpl);
            }
        }
    }


    function validate_ajax($request) {
        $this->model = new comment();
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'comment' => 'required|string|min:3|max:255',
            'product_id' => 'required|numeric|exists:products,id',
        ];

        return $this->validates($request,$rules,[
            'required' => ':attribute không được để trống',
            'email' => ':attribute hợp lệ',
            'regex' => ':attribute hợp lệ',
            'string' => ':attribute hợp lệ',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 3 kí tự',
        ], [
            'email' => 'Email',
            'comment' => 'Nội dung',
            'name' => 'Tên khách hàng',
        ]);
    }

    function before_save(&$model, $request) {
        $model->star = (int)$request->get('rating')[0];
        $model->name = $request->get('name');
        $model->email = $request->get('email');
        $model->comment = $request->get('comment');
        $model->product_id = $request->get('product_id');
    }


    function result_response(&$result, $model) {
        $result['reload'] = true;
    }




}