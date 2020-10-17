<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instancia-enunciado-form">

    <?php $form = ActiveForm::begin(); ?>

 

    <?= $form->field($model, 'c1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c6')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c8')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c9')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c10')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'respuesta')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
