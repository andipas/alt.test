<?php

namespace app\services;

use app\services\providers\RbkProvider;
use yii\base\Exception;

class ParserService
{
    const TYPE_RBK = 'rbk';

    private $url;

    public function parse($url)
    {
        $this->url = $url;

        switch ($this->getType()){
            case self::TYPE_RBK:
                return (new RbkProvider())->parse($url);
        }

        throw new Exception('Неизвестный источник для парсинга');
    }

    private function getType()
    {
        return self::TYPE_RBK;
    }
}