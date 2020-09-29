<?php

namespace app\services;

use app\models\ParserConfig;
use app\services\providers\RbkProvider;
use app\services\providers\TassProvider;
use yii\base\Exception;

class ParserService
{
    /**
     * @param $url
     * @return ParserResponseDto
     * @throws Exception
     * @throws providers\NotFindDataException
     */
    public function parse($url) : ParserResponseDto
    {
        $type = ParserConfig::getTypeByUrl($url);

        if(!$type){
            throw new Exception('Неизвестный источник для парсинга');
        }

        switch ($type){
            case ParserConfig::TYPE_RBK:
                return (new RbkProvider())->parse($url);

            case ParserConfig::TYPE_TASS:
                return (new TassProvider())->parse($url);
        }
    }

}