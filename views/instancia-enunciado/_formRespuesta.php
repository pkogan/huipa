<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instancia-enunciado-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'respuesta')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
