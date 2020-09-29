<?php

namespace app\services;


use app\models\Post;
use yii\db\Exception;
use yii\db\Expression;
use Yii;

class PostStorageService
{
    private $error = '';

    /**
     * @param  ParserResponseDto  $dto
     * @return Post
     * @throws \yii\base\Exception
     */
    public function create(ParserResponseDto $dto) : Post
    {
        $transaction = Yii::$app->db->beginTransaction();

        $this->error = '';

        try {
            $post = new Post();
            $post->title = $dto->title;
            $post->body = $dto->body;
            $post->parse_url = $dto->parse_url;
            $post->created_at = new Expression('NOW()');
            $post->parsed_at = new Expression('NOW()');
            $post->updated_at = null;
            $post->save(false);

            $imageService = new ImageStorageService();

            foreach($dto->images as $url){
                $imageService->create($url, $post->id);
            }

            $transaction->commit();

            return $post;
        } catch (Exception $exception){
            $transaction->rollBack();
            throw new \yii\base\Exception($exception->getMessage());
        }
    }

    public function getError()
    {
        return $this->error;
    }
}