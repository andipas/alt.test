<?php

namespace app\helpers;


class UserHelper
{
    public static function isAdmin()
    {
        return \Yii::$app->user->identity->isAdmin ?? false;
    }
}