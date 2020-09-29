<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property int $post_id
 * @property string $name
 * @property string $parse_url
 * @property string $created_at
 *
 * @property Post $post
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'name', 'parse_url', 'created_at'], 'required'],
            [['post_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'parse_url'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Page ID',
            'name' => 'Name',
            'parse_url' => 'Parse Url',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public static function getUploadDir($postId)
    {
        $dir = Yii::getAlias('@webroot/uploads');
        $dir .= DIRECTORY_SEPARATOR.$postId;

        if(!is_dir($dir)){
            FileHelper::createDirectory($dir);
        }

        return $dir;
    }

    public function getFilePath()
    {
        return self::getUploadDir($this->post_id).DIRECTORY_SEPARATOR.$this->name;
    }

    public function unlinkFile()
    {
        $file = $this->getFilePath();
        if(is_file($file)){
            return unlink($file);
        }

        return null;
    }

    public function getFileUrl()
    {
        return Yii::getAlias('@web/uploads').'/'.$this->post_id.'/'.$this->name;
    }
}
