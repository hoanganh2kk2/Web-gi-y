<?php

namespace App\Http\Service\Media;

use App\Hps\eJson;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Intervention\Image\ImageManagerStatic;

class UploadMediaService
{

    /***
     * Định nghĩa kiểu của đối tượng: value của trường type
     */
    const TYPE_IS_IMAGE = 'image';
    const TYPE_IS_DOC = 'doc';
    const TYPE_IS_VIDEO = 'video';

    private static $mediaUpload = [
        'folder' => 'data/upload/',
        'path'   => '',
    ];


    function upload($name = null, $return = false)
    {
        try {
            $media = [];
            $files = $name ? Request::file($name) : Request::file('file');
            if(is_array($files)) {
                foreach ($files as $item){
                    $media[] = $this->processUpload($item);
                }
                $media['media'] = $media;
            }else{
                $media = $this->processUpload($files);
                $media = [
                    'media' => $media
                ];
            }

            if($return) {
                return $media;
            }
            eJson::getInstance()->getJsonSuccess('Upload ảnh thành công', $media);

        }catch (\Exception $e) {
            app(Handler::class)->report($e);
            eJson::getInstance()->getJsonError('Cập nhật thất bại');
        }
    }



    function processUpload($file): array
    {
        $subFolder = date('Y/md/');
        $destinationPath = self::getUploadPath($subFolder); // upload path
        $_file_name = $file->getClientOriginalName(); //$file['name']; // renaming image
        $nameFileWithOutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_file_name);
        $extension = get_file_extension($_file_name);
        $fileNew = \Illuminate\Support\Str::slug($nameFileWithOutExt) . $extension;
        $fSize = $file->getSize();
        $file->move($destinationPath, $fileNew);
        $fType = self::TYPE_IS_DOC;
        if (in_array(strtolower($extension), ['.png', '.jpg', '.jepg', '.jpeg', '.webp'])) {
            $fType = self::TYPE_IS_IMAGE;
        }

        if ($fType === self::TYPE_IS_IMAGE) {
            try {
                $imagePath = $destinationPath . $fileNew;
                ImageManagerStatic::make($file)
                    ->resize(1000, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($imagePath, 50, 'jpg');
            } catch (\Exception $err) {};
        }

        $saveMedia = [
            'name' => $nameFileWithOutExt,
            'type' => $fType,
            'size' => $fSize,
            'format' => $extension,
            'created_at' => time(),
            'relative_link' => self::getUploadFolder($subFolder) . $fileNew,
        ];
        $saveMedia['absolute_link'] = url($saveMedia['relative_link']);

        $id = DB::table('media')->insertGetId($saveMedia);
        return [
            'id' => $id,
            'relative_link' => $saveMedia['relative_link'],
            'absolute_link' => $saveMedia['absolute_link'],
            'url' => $saveMedia['absolute_link'],
            'name' => $saveMedia['name'],
            'format' => $extension,
        ];
    }

    /***
     * @return mixed
     */

    static function getUploadPath($folder = '')
    {
        return public_path(config('filesystems.media_folder') . "/upload/") . $folder;
    }

    /***
     * @return mixed
     */

    static function getUploadFolder($folder, $extra = true)
    {
        if ($extra) {
            return self::$mediaUpload['folder'] . $folder;
        } else {
            return $folder;
        }
    }



}
