<?php

namespace App\Http\Service\Media;

use Imagick;
use Intervention\Image\ImageManagerStatic;

abstract class MediaService
{
    static function getImageSrc($src, $fullurl = true, $sizeName = false)
    {
        if (!$src) {
            return url('assets/images/no-img.jpeg');
        }
        if (isLink($src)) {
            return $src;
        }
        //$src = self::compressImage($src);
        if (!$sizeName) {
            return self::buildImageLink($src, $fullurl);
        }
        $link_image_admin = self::buildImageLink($src, $fullurl);
        return self::thumb($link_image_admin, $src, $sizeName);
    }

    static function compressImage($src) {
        try {
//            $file_type = pathinfo($src, PATHINFO_EXTENSION); // lấy ra loại file (vd: jpg, png, ...)
//            $file_data = file_get_contents($src); // đọc nội dung file
//            $base64 = 'data:image/' . $file_type . ';base64,' . base64_encode($file_data); // chuyển đổi thành base64
            // Đường dẫn tới ảnh cần giảm dung lượng
            $img = ImageManagerStatic::make($src);

            // Giảm chất lượng ảnh
            $img->save($src, 60);

            // Kiểm tra dung lượng ảnh
            $fileSize = filesize($src);
            if ($fileSize > 100 * 1024) {
                // Nếu dung lượng ảnh vẫn lớn hơn 100KB thì thực hiện giảm chất lượng ảnh đến khi dung lượng nhỏ hơn 100KB
                $quality = 60;
                while ($fileSize > 100 * 1024 && $quality >= 10) {
                    $quality -= 10;
                    $img->save($src, $quality);
                    $fileSize = filesize($src);
                }
            }
            return $src;
        }catch (\Exception $e) {
            return $src;
        }
    }


    static function buildImageLink($src, $fullurl = true, $no_image = '')
    {
        if (!$src) {
            if (!$no_image) {
                return url('assets/images/no-img.jpeg');
            } else {
                return $no_image;
            }
        }
        if (isLink($src) || !$fullurl) {
            return $src;
        }
        return config('filesystems.media_domain'). $src . '?ver=1309';
    }


    static function thumb($link_image_admin, $filename, $sizeName) {
        $_src = explode('/', $filename);
        $_src[0] = 'thumbs/' . $sizeName;//replace thư mục images gốc thành thư mục thumbs/size
        $src = implode('/', $_src);

        $src = 'data/'.$src;
        $dir = public_path(dirname($src));

        if (! \File::exists($dir)) {
            \File::makeDirectory($dir, 0755, true);
        }else {
            if(\File::exists(public_path($src))) {
                return public_link($src);
            }
        }
        switch ($sizeName) {
            case 'big':
                $width = 688;
                $height = 268;
                break;
            case 'medium':
                $width = 400;
                $height = 400;
                break;
            case 'small':
                $width = 72;
                $height = 72;
                break;
            case 'new':
                $width = 250;
                $height = 110;
                break;
            default:
                $width = 720;
                $height = 400;
                break;
        }
        try {
            ImageManagerStatic::make($link_image_admin)
                ->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($src, 90);
        }catch (\Exception $e) {
            return $link_image_admin;
        }
        return public_link($src);
    }

    public function getFileLink($link): string
    {
        if (isLink($link)) {
            return $link;
        }
        $url = $link['src'] ?? $link;
        return config('filesystems.media_domain').$url;
    }
}