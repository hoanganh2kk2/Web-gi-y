<?php

namespace App\Http\Controllers\FrontEnd\Home;

use App\Hps\eJson;
use App\Hps\eView;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\Post;
use App\Models\ProductModel;
use App\Models\Video;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends FrontEndController
{

    public function __construct()
    {
        $this->dir = __DIR__;
        $this->seo()->setTitle('Trang chủ');
        SEOMeta::setKeywords('HomePage');
        $this->seo()->setDescription('Trang chủ của website này là nơi đầu tiên mà khách hàng sẽ đến khi truy cập vào trang web của chúng tôi. Tại đây, bạn sẽ tìm thấy một tầm nhìn tổng quan về sản phẩm hoặc dịch vụ của chúng tôi cùng với những thông tin mới nhất và những sản phẩm được quảng cáo đặc biệt.');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
    }


    function list(Request $request){
        $tpl = [];
        $categories = Category::query()->active()->orderByDesc('id')->get();
        $catenew = $categories->take(2);
        $pluckCatenew = $catenew->pluck('id');
        $product = ProductModel::query()->active()->typeOfficial()->get();
        $schema =[
            'type' => 'HomePage',
            'name' => 'Trang chủ',
            'description' => 'Trang chủ của website này là nơi đầu tiên mà khách hàng sẽ đến khi truy cập vào trang web của chúng tôi. Tại đây, bạn sẽ tìm thấy một tầm nhìn tổng quan về sản phẩm hoặc dịch vụ của chúng tôi cùng với những thông tin mới nhất và những sản phẩm được quảng cáo đặc biệt.',
            'url' => route('fe.home')
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        if($pluckCatenew->count() === $catenew->count()) {
            $catenew1 = @$pluckCatenew[0];
            $catenew2 = @$pluckCatenew[1];
            $product1 = ProductModel::query()->whereRaw('JSON_CONTAINS(category_id, \'["' . $catenew1 . '"]\')')->take(8)->get();
            $product2 = ProductModel::query()->whereRaw('JSON_CONTAINS(category_id, \'["' . $catenew2 . '"]\')')->take(8)->get();
            $productn1[$catenew1] = $product1;
            $productn2[$catenew2] = $product2;
            $productn = [$productn1, $productn2];
            $tpl['productn'] = $productn;
        }
        $bestSale = $product->sortByDesc('view')->take(8);
        $bestlike = $product->sortByDesc('like')->take(8);
        $newProduct = $product->sortByDesc('id')->take(12);
        $newProduct1 = $product->whereNotIn('id', $bestlike->pluck('id')->toArray())->sortByDesc('id')->take(8);
        $tpl['categories'] = $categories->keyBy('id');
        $tpl['products'] = $product;
        $tpl['catenew'] = $catenew;
        $tpl['bestlike'] = $bestlike;
        $tpl['newProduct'] = $newProduct;
        $tpl['newProduct1'] = $newProduct1;
        $tpl['bestSale'] = $bestSale;
        $tpl['groupCate'] = $categories->groupBy('parent_id');
        return eView::getInstance()->setView($this->dir, 'home', $tpl);
    }


}