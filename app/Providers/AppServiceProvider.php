<?php

namespace App\Providers;

use App\Hps\eCache;
use App\Http\Controllers\BackEnd\Menu\MenuController;
use App\Http\Controllers\FrontEnd\Sitemap\SitemapController;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Config;
use App\Models\Menu;
use App\Models\ProductModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Spatie\Sitemap\Sitemap;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
//        $info = eCache::getInstance()->get('info');
        $menu = eCache::getInstance()->get('menu');
//        if(!$info) {
//            $info = Config::query()->first();
//            eCache::getInstance()->add('info', $info);
//        }
//        if(!$menu) {
//            $menu = Menu::query()->where('status', BaseModel::getStatusActive())
//                ->with(['apply_rele', 'post_static', 'parent.apply_rele', 'parent.post_static'])->get()->groupBy('type');
//            eCache::getInstance()->add('menu', $menu);
//        }
//        $info = Config::query()->first();
//        $menu = Menu::query()->where('status', BaseModel::getStatusActive())
//            ->with(['apply_rele', 'post_static'])->orderByDesc('stt')->get()->groupBy('type');
//        $menuHeader = $menuFooter = [];
//        if(!$menu->isEmpty()) {
//            $menu = $menu->toArray();
//            if(isset($menu[1])) {
//                $menuHeader = app(MenuController::class)->buildMenuHeader($menu[1]);
//            }
//            if(isset($menu[2])) {
//                $menuFooter = app(MenuController::class)->buildMenuFooter($menu[2]);
//            }
//        }
////
//        $cate = Category::query()->active()->where('type','<>', Category::get_type_tag())->get(['id', 'name']);
//
//        $product = $product = ProductModel::query()->active()->typeOfficial()->orderByDesc('id')->first();
//
//        $sites = SitemapController::get_site_map(false);
//        $sitemap = Sitemap::create();
//        foreach ($sites as $site) {
//            if (!empty($site)) {
//                $sitemap->add($site);
//            }
//        }
//        $sitemap->writeToFile(public_path('sitemap.xml'));
//
//        view()->share('info', $info);
//        view()->share('categories', $cate);
//        view()->share('productbuy', $product);
//        view()->share('menuHeader', $menuHeader);
//        view()->share('menuFooter', $menuFooter);
//
    }


}
