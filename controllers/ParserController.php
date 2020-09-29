<?php

namespace app\controllers;


use app\models\ParserForm;
use app\services\ParserService;
use app\services\PostStorageService;
use yii\base\Exception;
use yii\web\Controller;
use Yii;

class ParserController extends Controller
{
    public function actionCreate()
    {
        $model = new ParserForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $parserService = new ParserService();
                $postService = new PostStorageService();

                $response = $parserService->parse($model->url);
                $post = $postService->create($response);

                Yii::$app->session->setFlash('success', 'Данные получены успешно из '.$model->url);
                return $this->redirect(['/post/view', 'id' => $post->id]);

            } catch (Exception $exception){
                $model->addError('url', $exception->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}