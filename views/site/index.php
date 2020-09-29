<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\debug\models\timeline\DataProvider */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Какие новости?</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?php
                if($dataProvider->models){
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_list_item',
                    ]);
                } else {
                    echo \yii\helpers\Html::tag('h2', 'Пока никаких.');

                    if(Yii::$app->user->isGuest){
                        echo \yii\helpers\Html::a('Войдите', ['/site/login']).' под админом: admin/admin и добавьте новости.';
                    } else {
                        echo \yii\helpers\Html::a('Добавить', ['/parser/create'], ['class' => 'btn btn-success']);
                    }
                }

                ?>
            </div>
        </div>

    </div>
</div>
