<?php

namespace App\Http\Controllers\FrontEnd\Categories;

use App\Hps\eView;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Models\Category;
use App\Models\Post;
use App\Models\ProductModel;
use App\Models\Statics;
use App\Models\Video;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoriesController extends FrontEndController
{
    public function __construct()
    {
        $this->model = new Category();
        $this->dir = __DIR__;
    }

    function check_list($slug)
    {
        $categories = $this->model->active()->where('slug',$slug)->first();

        if( $slug === 'san-pham') {
            $categories = $slug;
            return $this->list_product($categories);
        }
        if(!$categories) {
            return eView::getInstance()->notfoundClient();
        }
        if ($categories['type']['id'] === $this->model->get_type_product()){
            return $this->list_product($categories);
        }
        else{
            return eView::getInstance()->notfoundClient();
        }
    }

    function list_product($category) {
        $tpl = [];
        $this->set_cate($tpl);
        $description = 'Trang danh sách sản phẩm trên website này là nơi tổng hợp và hiển thị tất cả các sản phẩm được cung cấp trên trang web. Tại đây, bạn có thể dễ dàng tìm kiếm và xem các sản phẩm mới nhất hoặc các sản phẩm theo danh mục, thương hiệu hoặc chủ đề.
        Trang danh sách sản phẩm trên website này là nơi tổng hợp và hiển thị tất cả các sản phẩm được cung cấp trên trang web. Tại đây, bạn có thể dễ dàng tìm kiếm và xem các sản phẩm mới nhất hoặc các sản phẩm theo danh mục, thương hiệu hoặc chủ đề.
        Chúng tôi cập nhật các sản phẩm đều đặn, đảm bảo rằng bạn luôn có sự lựa chọn đa dạng và phù hợp với nhu cầu của bạn. Trang danh sách sản phẩm được thiết kế để giúp bạn tiết kiệm thời gian và nỗ lực trong việc tìm kiếm sản phẩm bằng cách cung cấp một bộ lọc để tìm kiếm sản phẩm theo từ khóa, danh mục hoặc thương hiệu.';
        if($category === 'san-pham') {
            $this->seo()->setTitle('Danh sách sản phẩm');
        }else{
            $this->seo()->setTitle('Danh sách sản phẩm '.$category['name']);
        }
        SEOMeta::setKeywords('Sản phẩm');
        $this->seo()->setDescription($description);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        $schema =[
            'type' => 'listProduct',
            'name' => 'Danh sách sản phẩm',
            'description' => $description,
            'url' => isset($category['slug']) ? get_link_cate($category['slug']) : get_link_cate($category),
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        $products = ProductModel::query()->active()->typeOfficial();
        if($category !== 'san-pham') {
            $products = $products->whereRaw('JSON_CONTAINS(category_id, \'["' . $category['id'] . '"]\')');
        }
        $products  = $products->paginate(12);
        $tpl['products'] = $products;
        return eView::getInstance()->setView($this->dir, 'productsList', $tpl);
    }


    function set_cate(&$tpl) {
        $categories = Category::query()->active()->where('type',Category::get_type_product())->orderByDesc('id')->get();
        $cateBlock = $categories->take(5);
        $count = $categories->count() - $cateBlock->count();
        $cateNone = $categories->slice(5, $count);
        $newProduct = ProductModel::query()->active()->typeOfficial()->orderByDesc('id')->take(5)->get();
        $tpl['cateBlock'] = $cateBlock;
        $tpl['cateNone'] = $cateNone;
        $tpl['newProduct'] = $newProduct;
    }



}