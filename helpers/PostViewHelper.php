<?php

namespace app\helpers;


use app\models\Post;
use yii\helpers\Html;

class PostViewHelper
{
    public static function getImagesHtml(Post $post)
    {
        $htm = '';
        foreach ($post->images as $image) {
            $fileUrl = $image->getFileUrl();
            $parseLink = Html::a($image->parse_url, $image->parse_url);
            $uploadLink = Html::a($fileUrl, $fileUrl);
            $img = Html::img($fileUrl, ['class' => 'thumb']);
            $img .= Html::tag('div', Html::tag('p', 'parse url:'.$parseLink), ['class' => 'caption']);
            $img .= Html::tag('div', Html::tag('p', 'upload url:'.$uploadLink), ['class' => 'caption']);
            $thumb = Html::tag('div', $img, ['class' => 'thumbnail']);
            $htm .= Html::tag('div', $thumb, ['class' => 'col-sm-6 col-md-4 col-lg-3 h-390']);
        }

        return $htm;
    }
}