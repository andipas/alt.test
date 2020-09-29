<?php

namespace app\models;


use yii\base\Model;

class ParserForm extends Model
{
    public $url;

    public function rules()
    {
        return [
            ['url',  'required'],
            ['url',  'url'],
            ['url',  'validUrl'],
        ];
    }

    public function validUrl()
    {
        if(ParserConfig::getTypeByUrl($this->url) === 0){
            $this->addError('url', 'Укажите ссылку из rbc.ru или tass.ru');
        }
    }
}