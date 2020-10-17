<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudianteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examen-estudiante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idExamenEstudiante') ?>

    <?= $form->field($model, 'idExamen') ?>

    <?= $form->field($model, 'idEstudiante') ?>

    <?= $form->field($model, 'hash') ?>

    <?= $form->field($model, 'idEstado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
