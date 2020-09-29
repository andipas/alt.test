<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $parse_url
 * @property string $parsed_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Image[] $images
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['parsed_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'parse_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'body' => 'Текст',
            'parse_url' => 'Parse Url',
            'parsed_at' => 'Дата парсинга',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['post_id' => 'id']);
    }
}
