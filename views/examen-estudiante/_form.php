<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudiante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examen-estudiante-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= //$form->field($model, 'idEstudiante')->textInput() 
         $form->field($model, 'idEstudiante')->dropDownList(\app\models\Estudiante::find()
            ->select(['apellidoNombre'])
            ->orderBy('apellidoNombre')
            ->indexBy('idEstudiante')
            ->column())
    ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
