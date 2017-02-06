<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WinningNumbersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="winning-numbers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['data'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'datenumber')->label("搜索栏：")->textInput(['placeholder' => '期号', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red1')->label(false)->textInput(['placeholder' => '红球1', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red2')->label(false)->textInput(['placeholder' => '红球2', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red3')->label(false)->textInput(['placeholder' => '红球3', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red4')->label(false)->textInput(['placeholder' => '红球4', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red5')->label(false)->textInput(['placeholder' => '红球5', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'red6')->label(false)->textInput(['placeholder' => '红球6', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'blue')->label(false)->textInput(['placeholder' => '篮球', 'style' => 'width: 80px']) ?>
    <?= $form->field($model, 'date')->label(false)->textInput(['placeholder' => '开奖日期', 'style' => 'width: 100px']) ?>

    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
