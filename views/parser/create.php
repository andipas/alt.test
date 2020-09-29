<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParserForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Парсить';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/post/index']];
$this->params['breadcrumbs'][] = $this->title;

$hint = 'Укажите страницу новости '.\app\models\ParserConfig::getLinkString();
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint($hint) ?>

    <div class="form-group">
        <?= Html::submitButton('Парсим', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
