<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Examen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= //$form->field($model, 'fecha')->textInput()
         $form->field($model, 'fecha')
         ->widget(
                 kartik\datetime\DateTimePicker::className(),
             [
                 'options' => ['placeholder' => 'fecha'
                     ],
                 //'convertFormat' => true,
                 'pluginOptions' => [
                     'format' => 'yyyy-mm-dd hh:ii',
                 ],
         ])?>

    <?= $form->field($model, 'idTemplate')->textInput() ?>

    <?= $form->field($model, 'cco')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
