<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEnunciado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examen-enunciado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= //$form->field($model, 'idMetaEnunciado')->textInput() 
     $form->field($model, 'idMetaEnunciado')->dropDownList(\app\models\MetaEnunciado::find()
            ->select(['nombre'])
            ->orderBy('nombre')
            ->indexBy('idMetaEnunciado')
            ->column())?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
