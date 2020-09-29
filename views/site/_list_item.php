<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $model \app\models\Post */
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= HtmlPurifier::process($model->body) ?>

    <?php
    echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'parse_url:url',
            [
                'label' => 'Картинки',
                'value' => function (\app\models\Post $post) {
                    return \app\helpers\PostViewHelper::getImagesHtml($post);
                },
                'format' => 'raw',
            ],
            'parsed_at',
            'created_at',
            'updated_at',
        ],
    ])
    ?>
</div>

<hr>