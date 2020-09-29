<?php

namespace app\models;


use yii\helpers\Html;

class ParserConfig
{
    const TYPE_RBK = 1;
    const TYPE_TASS = 2;

    public static function getParserConfig()
    {
        return [
            'ТАСС' => [
                'rule' => '/tass\.ru/',
                'type' => self::TYPE_TASS,
                'url' => 'https://www.tass.ru',
            ],
            'РБК' => [
                'rule' => '/rbc\.ru/',
                'type' => self::TYPE_RBK,
                'url' => 'https://www.rbc.ru',
            ],
        ];
    }

    public static function getLinkString()
    {
        $arr = [];
        foreach (self::getParserConfig() as $name => $config){
            $arr[] = Html::a($name, $config['url'], ['target' => '_blank']);
        }

        return implode(' или ', $arr);
    }

    public static function getTypeByUrl($url)
    {
        foreach (self::getParserConfig() as $name => $config){
            if(preg_match($config['rule'], $url)){
                return $config['type'];
            }
        }

        return 0;
    }
}