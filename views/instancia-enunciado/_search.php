<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instancia-enunciado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idInstanciaEnunciado') ?>

    <?= $form->field($model, 'idMetaEnunciado') ?>

    <?= $form->field($model, 'c1') ?>

    <?= $form->field($model, 'c2') ?>

    <?= $form->field($model, 'c3') ?>

    <?php // echo $form->field($model, 'c4') ?>

    <?php // echo $form->field($model, 'c5') ?>

    <?php // echo $form->field($model, 'c6') ?>

    <?php // echo $form->field($model, 'c7') ?>

    <?php // echo $form->field($model, 'c8') ?>

    <?php // echo $form->field($model, 'c9') ?>

    <?php // echo $form->field($model, 'c10') ?>

    <?php // echo $form->field($model, 'respuesta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
