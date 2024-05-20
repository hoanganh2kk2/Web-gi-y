<?php

use App\Hps\eDate;
use App\Hps\eHelper;
use App\Hps\eQuery;
use App\Hps\eTransaction;
use App\Http\Service\Media\MediaService;
use App\Models\Cart;
use App\Models\CartItem;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (! function_exists('images_src')) {
    function images_src($relative_link): string
    {
        if(!$relative_link){
            $relative_link = 'assets/images/no-img.png';
        }
        return env('MEDIA_DOMAIN').'/'.$relative_link;
    }
}

if (! function_exists('format_timestamp_to_date')) {
    function format_timestamp_to_date($timestamp)
    {
        return date('d/m/Y H:i:s', $timestamp);
    }
}

if (!function_exists('admin_link')) {
    function admin_link($router = '')
    {
        return url(str_replace('//', '/', '/' .'admin/'. $router));
    }
}

if (!function_exists('public_link')) {
    function public_link($router = '')
    {
        return url(str_replace('//', '/', '/' . $router));
    }
}

if (!function_exists('show_money')) {
    function show_money($value, $default = 'Chưa cập nhật'): string
    {
        if (is_numeric($value)) {
            if (empty($value)) {
                return $default;
            }
            return eHelper::getInstance()->formatMoney($value);
        }

        return $default;
    }
}


if (!function_exists('show_number')) {

    function show_number($value, $default = 'Chưa cập nhật')
    {
        if (is_numeric($value)) {
            if (empty($value)) {
                return $default;
            }
            return eHelper::getInstance()->formatNumber($value);
        }
        return $default;
    }
}

if (!function_exists('build_token')) {
    function build_token($id): string
    {
        return eHelper::getInstance()->buildTokenString($id);
    }
}

if (!function_exists('validate_token')) {
    function validate_token($string): bool
    {
        return eHelper::getInstance()->validateToken($string);
    }
}

if (! function_exists('media_absolute_link')) {
    function media_absolute_link($link): string
    {
        return asset($link);
    }
}

if (!function_exists('value_show')) {
    function value_show($value, $default = '---')
    {
        if (is_string($value) || is_numeric($value)) {
            if (empty($value)) {
                return $default;
            }
            return $value;
        }
        if (is_array($value)) {
            if (isset($value['name']) && is_string($value['name'])) {
                return $value['name'];
            } else if (isset($value['value']) && is_string($value['value'])) {
                return $value['value'];
            } else {
                return $default;
            }
        }

        return $default;
    }
}

if (!function_exists('show_int_date')) {
    function show_int_date($date, $format = 'd/m/Y H:i:s'): string
    {
        if ($date) {
            return eDate::getInstance()->dateFormat($date, $format);
        }
        return 'd/m/Y H:i:s';
    }
}

if (!function_exists('convert_date_to_int')) {
    function convert_date_to_int($date, $end = false, $start = false)
    {
        return eDate::getInstance()->getTimestampFromVNDate($date, $end, $start);
    }
}

if (!function_exists('check_info_query')) {
    function check_info_query()
    {
        eQuery::getInstance()->check_query();
    }
}

if (!function_exists('get_info_query')) {
    function get_info_query()
    {
        eQuery::getInstance()->get_query();
    }
}

if (! function_exists('isLink')) {
    function isLink($link)
    {
        return filter_var($link, FILTER_VALIDATE_URL);
    }
}

if (! function_exists('get_file_extension')) {
    function get_file_extension($file)
    {
        $pos = strrpos($file, '.');
        if (!$pos) {
            return FALSE;
        }
        $str = substr($file, $pos, strlen($file));

        return strtolower($str);
    }
}

if (!function_exists('begin_transaction')) {
    function begin_transaction()
    {
        eTransaction::getInstance()->begin_transaction();
    }
}

if (!function_exists('transaction_commit')) {
    function transaction_commit()
    {
        eTransaction::getInstance()->transaction_commit();
    }
}

if (!function_exists('transaction_roll_back')) {
    function transaction_roll_back()
    {
        eTransaction::getInstance()->transaction_roll_back();
    }
}

if (! function_exists('get_link_cate')) {
    function get_link_cate($link = ''): string
    {
        if(!$link) {
            return 'javascript:void(0)';
        }
        return url(str_replace('//', '/', '/' .'cate/'. $link.'.html'));
    }
}

if (! function_exists('get_link_product')) {
    function get_link_product($link = ''): string
    {
        if(!$link) {
            return 'javascript:void(0)';
        }
        return url(str_replace('//', '/', '/' .'product/'. $link.'.html'));
    }
}

if (! function_exists('get_link_post')) {
    function get_link_post($link = ''): string
    {
        if(!$link) {
            return 'javascript:void(0)';
        }
        return url(str_replace('//', '/', '/' .'post/'. $link.'.html'));
    }
}


if (!function_exists('where_like')) {
    function where_like($query, $attr, $name)
    {
        return $query->where($attr, 'LIKE', "%{$name}%");
    }
}

if (!function_exists('check_request_field')) {
    function check_request_field(Request $request, $field): bool
    {
        if ($request->has($field) && !empty($request->filled($field))) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('get_img_video_youtobe')) {
    function get_img_video_youtobe($video_id): string
    {
        return 'https://i.ytimg.com/vi/'.$video_id.'/hqdefault.jpg';
    }
}

if (! function_exists('show_img')) {
    function show_img($src = '',$fullurl = true, $sizeName = false): string
    {
        return MediaService::getImageSrc($src, $fullurl,$sizeName) ;
    }
}


if (!function_exists('process_range_date')) {
    function process_range_date($time, $time_format = 'mongodb', $spliter = 'to', $range = true)
    {
        if (is_string($time) && $time) {
            $updated_at_arr = explode($spliter, $time);
            if (!isset($updated_at_arr[1]) && $range == true) {
                $updated_at_arr[1] = $updated_at_arr[0];//tìm trong ngày
            }
            if ($updated_at_arr && isset($updated_at_arr[0]) && isset($updated_at_arr[1])) {
                $timeStart = trim($updated_at_arr[0]);
                $timeEnd = trim($updated_at_arr[1]);
                if (eDate::validateDateTime($timeStart, 'd/m/Y') && eDate::validateDateTime($timeEnd, 'd/m/Y')) {
                    if ($time_format === 'int') {
                        $timeStart = show_int_date($timeStart, false);
                        $timeEnd = show_int_date($timeEnd, true);
                    }
                    return [
                        'time_start' => $timeStart,
                        'time_end' => $timeEnd,
                    ];
                }
            }
        }
    }
}

if (! function_exists('dequyrele')) {
    function dequyrele($rele, $item, $i = 0, &$data = []): int
    {
        foreach ($rele as $key) {
            if ($i == count($rele)) {
                return 0;
            }
            if ($data) {
                $data = $data[$key];
            } else {
                $data = $item[$key];
            }
            $i++;
        }
        return dequyrele($rele, $item, $i, $data);
    }
}

if (! function_exists('generate_product_code')) {
    function generate_product_code(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $length = rand(5, 7);
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }
}

if (! function_exists('show_fields')) {
    function show_fields($fields)
    {
        $fields = app(\App\Security\SecurityInterface::class)->rsa_decrypt($fields);
        if(!$fields) {
            return false;
        }
        return json_decode($fields);
    }
}

if (! function_exists('set_request')) {
    function set_request()
    {
        $fields = request('fields');
        if(!$fields) {
            return app(\App\Hps\eJson::class)->getJsonError('Không tìm thấy thông tin');
        }
        $value = show_fields($fields);
        if(!$value) {
            return app(\App\Hps\eJson::class)->getJsonError('Chữ ký không hợp lệ');
        }
        foreach ($value as $k => $item){
            request()->offsetSet($k, $item);
        }
    }
}



if (! function_exists('modpow')) {
    function modpow($a, $b, $n): int
    {
        $result = 1;
        $a = $a % $n;
        while ($b > 0) {
            if ($b % 2 == 1) {
                $result = ($result * $a) % $n;
            }
            $b = $b >> 1;
            $a = ($a * $a) % $n;
        }
        return $result;
    }
}

if (! function_exists('printMenu')) {
    function printMenu($groups, &$html = '', $i = 0, $k = 0)
    {
        if (count($groups) === 0) {
            return 0;
        }
        foreach ($groups as  $group) {
            $html .= '<ul class="acnav__list acnav__list--level' . ($k + 2) . '">';
            $html .= '<li class="has-children">';
            $html .= '<div class="d-flex acnav__label acnav__label--level' . ($i + 2) . '">';
            $html .= '<div class="col-10">';
            $html .= '<span>' .$group['name']. '</span>';
            $html .= '</div>';
            $html .= '<div class="col-2">
                                                        <a href="'.route(Route::current()->getName(), ['cmd' => 'input', 'id' => $group['id']]).'"
                                                           class="bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           data-original-title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa"
                                                           aria-label="Chỉnh sửa">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M11 4.00023H6.8C5.11984 4.00023 4.27976 4.00023 3.63803 4.32721C3.07354 4.61483 2.6146 5.07377 2.32698 5.63826C2 6.27999 2 7.12007 2 8.80023V17.2002C2 18.8804 2 19.7205 2.32698 20.3622C2.6146 20.9267 3.07354 21.3856 3.63803 21.6732C4.27976 22.0002 5.11984 22.0002 6.8 22.0002H15.2C16.8802 22.0002 17.7202 22.0002 18.362 21.6732C18.9265 21.3856 19.3854 20.9267 19.673 20.3622C20 19.7205 20 18.8804 20 17.2002V13.0002M7.99997 16.0002H9.67452C10.1637 16.0002 10.4083 16.0002 10.6385 15.945C10.8425 15.896 11.0376 15.8152 11.2166 15.7055C11.4184 15.5818 11.5914 15.4089 11.9373 15.063L21.5 5.50023C22.3284 4.6718 22.3284 3.32865 21.5 2.50023C20.6716 1.6718 19.3284 1.6718 18.5 2.50022L8.93723 12.063C8.59133 12.4089 8.41838 12.5818 8.29469 12.7837C8.18504 12.9626 8.10423 13.1577 8.05523 13.3618C7.99997 13.5919 7.99997 13.8365 7.99997 14.3257V16.0002Z"
                                                                          stroke="#0184fe" stroke-width="2" stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>';
            $html .= '</div>';
            if(isset($group['children'])) {
                $i++;
                printMenu($group['children'], $html, $i, $i--);
            }
            $html .= '</li>';
            $html .= '</ul>';
        }
    }
}

if (! function_exists('get_menu')) {
    function get_menu($groups)
    {
        printMenu($groups, $html);
        return $html;
    }
}


if (! function_exists('printMenuClient')) { // viết ngáo vì ko có time sửa
    function printMenuClient($groups, &$html = '')
    {
        if (count($groups) === 0) {
            return 0;
        }
        $html .= '<ul class="sub-menu">';
        foreach ($groups as $group) {
            $html .= '<li class="dropdown position-static">';
            if($group['relative_link']) {
                $html .= '<a class="f-sans-serif" href="'.$group['relative_link'].'">'.$group['name'];
                if (isset($group['children'])){
                    $html .= '<i class="ecicon eci-angle-right"></i>';
                }
                $html .= '</a>';
            }elseif($group['post_static_id']) {
                $html .= '<a class="f-sans-serif" href="'.get_link_post($group['post_static']['slug']).'">'.$group['name'];
                if (isset($group['children'])){
                    $html .= '<i class="ecicon eci-angle-right"></i>';
                }
                $html .= '</a>';
            }elseif($group['apply_rele']){
                $html .= '<a class="f-sans-serif" href="'.get_link_cate($group['apply_rele']['slug']).'">'.$group['name'];
                if (isset($group['children'])){
                    $html .= '<i class="ecicon eci-angle-right"></i>';
                }
                $html .= '</a>';
            }else{
                $html .= '<a class="f-sans-serif" href="javascript:void(0)"<i class="ecicon eci-angle-right"></i></a>';
            }
            if(isset($group['children'])) {
                $html .= '<ul class="sub-menu sub-menu-child">';
                foreach ($group['children'] as $item){
                    $html .= '<li>';
                    if($item['relative_link']) {
                        $html .= '<a  class="f-sans-serif" href="'.$item['relative_link'].'">'.$item['name'].'</a>';
                    } elseif($item['post_static_id']) {
                        $html .= '<a  class="f-sans-serif" href="'.get_link_post($item['post_static']['slug']).'">'.$item['name'].'</a>';
                    }elseif($item['apply_rele']){
                        $html .= '<a  class="f-sans-serif" href="'.get_link_cate($item['apply_rele']['slug']).'">'.$item['name'].'</a>';
                    }else{
                        $html .= '<a  class="f-sans-serif" href="javascript:void(0)">'.$item['name'].'</a>';
                    }
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}

if (! function_exists('printMenuMobileClient')) { // viết ngáo vì ko có time sửa
    function printMenuMobileClient($groups, &$html = '')
    {
        if (count($groups) === 0) {
            return 0;
        }
        $html .= '<ul class="sub-menu">';
        foreach ($groups as $group) {
            $html .= '<li>';
            if($group['relative_link']) {
                $html .= '<a class="f-sans-serif" href="'.$group['relative_link'].'">'.$group['name'];
                $html .= '</a>';
            } elseif($group['post_static_id']) {
                $html .= '<a class="f-sans-serif" href="'.get_link_post($group['post_static']['slug']).'">'.$group['name'];
                $html .= '</a>';
            }elseif($group['apply_rele']){
                $html .= '<a class="f-sans-serif" href="'.get_link_cate($group['apply_rele']['slug']).'">'.$group['name'];
                $html .= '</a>';
            }else{
                $html .= '<a class="f-sans-serif" href="javascript:void(0)"</a>';
            }
            if(isset($group['children'])) {
                printMenuMobileClient($group['children'], $html);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}


if (! function_exists('get_menu_client')) {
    function get_menu_client($groups)
    {
        printMenuClient($groups, $html);
        return $html;
    }
}

if (! function_exists('get_menu_moblile_client')) {
    function get_menu_moblile_client($groups)
    {
        printMenuMobileClient($groups, $html);
        return $html;
    }
}

if (! function_exists('set_seo')) {
    function set_seo($seo = '')
    {
        $key = [];
        if(isset($seo->keyword) && !empty($seo->keyword)){
            $key[] = $seo->keyword;
        }
        if(isset($seo->keyword_extra) && !empty($seo->keyword_extra)) {
            $key[] = $seo->keyword_extra;
        }
        if($key) {
            $key = implode(',', $key);
        }
        if($seo) {
            SEOTools::setTitle(@$seo->title);
            SEOTools::setDescription(@$seo->description);
            SEOMeta::setKeywords(@$key);
            SEOTools::opengraph()->addProperty('type', 'articles');
            SEOTools::jsonLd()->addImage(show_img(@$seo->images));
            SEOTools::setCanonical(url()->current());
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::twitter()->setTitle(@$seo->title);
            SEOTools::twitter()->setDescription(@$seo->description);
            SEOTools::opengraph()->setTitle(@$seo->title);
            SEOTools::opengraph()->setDescription(@$seo->description);
            SEOTools::opengraph()->addImage(show_img(@$seo->images));
        }
    }
}

if (! function_exists('generateMetaTags')) {
    function generateMetaTags($seo = '')
    {
        // Thiết lập các thuộc tính cơ bản
        SEOTools::setTitle(@$seo->title);
        SEOTools::setDescription(@$seo->description);
        SEOMeta::setKeywords(@$seo->keyword);
        SEOTools::opengraph()->setTitle(@$seo->title);
        SEOTools::opengraph()->setDescription(@$seo->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setTitle(@$seo->title);
        SEOTools::twitter()->setDescription(@$seo->description);
        SEOTools::setCanonical(url()->current());

        // Thiết lập các thuộc tính nâng cao
        SEOTools::opengraph()->addImage(show_img(@$seo->images));
//        SEOTools::opengraph()->addImage([
//            'url' => @$seo->images,
//            'size' => 300
//        ]);
//        SEOTools::opengraph()->addImage([
//            'url' => 'https://example.com/image3.jpg',
//            'height' => 200,
//            'width' => 300
//        ]);
//        SEOTools::opengraph()->addImage([
//            'path' => '/image4.jpg',
//            'secure_url' => 'https://example.com/image4.jpg'
//        ]);
//        SEOTools::opengraph()->addAudio('https://example.com/audio.mp3');
//        SEOTools::opengraph()->addVideo([
//            'url' => 'https://example.com/video.mp4',
//            'type' => 'application/mp4',
//            'width' => 640,
//            'height' => 480,
//            'secure_url' => 'https://example.com/video.mp4',
//            'duration' => 100
//        ]);
//        SEOTools::twitter()->setSite('@mytwitteraccount');
        SEOTools::jsonLd()->addImage(show_img(@$seo->images));
//        SEOTools::jsonLd()->addImage([
//            'url' => 'https://example.com/image2.jpg',
//            'width' => 300,
//            'height' => 200
//        ]);
    }
}

if (! function_exists('percent_discount')) {
    function percent_discount($discount1, $discount2)
    {
        return 100 - ($discount1/$discount2)*100;
    }
}

if (! function_exists('check_cart')) {

    function check_cart(): int
    {
        $cart = Cart::query()->where('customer_id', auth()->id())->first();
        if (!$cart) {
            return 0;
        }
        $cart_id = $cart['id'];
        return CartItem::query()->where('cart_id', $cart_id)->count();
    }
}


if (! function_exists('get_cart')) {
    function get_cart()
    {
        $cart = Cart::query()->where('customer_id', auth()->id())->first();
        if (!$cart) {
            return 0;
        }
        $cart_id = $cart['id'];
        return CartItem::query()->with('color','size')->where('cart_id', $cart_id)->get();
    }
}




if (! function_exists('setSchema')) {
    function setSchema($data = []): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => $data['type'],
            'name' => $data['name'],
            'description' => $data['description'],
            'url' =>  $data['url'],
        ];
        if(isset( $data['avatar'])) {
            $schema['image'] =  $data['avatar'];
        }
        return  $schema;
    }
}