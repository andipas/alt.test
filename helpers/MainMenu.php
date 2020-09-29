<?php

namespace app\helpers;

use Yii;
use yii\helpers\Html;

class MainMenu
{
    public static function getTopMenuItems()
    {
        $items = [
            ['label' => 'Главаная', 'url' => ['/site/index']],
            //['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
        ];

        if(Yii::$app->user->isGuest){
            $items[] = ['label' => 'Вход', 'url' => ['/site/login']];
        } else {
            $items[] = ['label' => 'Новости', 'url' => ['/post/index']];

            $items[] =
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        return $items;
    }
}