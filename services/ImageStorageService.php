<?php

namespace app\services;


use app\helpers\RequestHelper;
use app\models\Image;
use GuzzleHttp\Client;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;

class ImageStorageService
{
    /**
     * @param $url
     * @param $postId
     * @return Image
     * @throws Exception
     */
    public function create($url, $postId)
    {
        $parse = pathinfo($url);

        $dir = Image::getUploadDir($postId);

        $name = $parse['basename'];

        $res = RequestHelper::getDataByUrl($url);

        if(!file_put_contents($dir.DIRECTORY_SEPARATOR.$name, $res)){
            throw new Exception('Не получилось загрузить картинку '.$url);
        }

        $image = new Image();
        $image->name = $name;
        $image->parse_url = $url;
        $image->created_at = new Expression('NOW()');
        $image->post_id = $postId;
        $image->save(false);

        return $image;
    }
}