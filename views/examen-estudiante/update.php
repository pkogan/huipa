<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudiante */

$this->title = 'Update Examen Estudiante: ' . $model->idExamenEstudiante;
$this->params['breadcrumbs'][] = ['label' => 'Examen Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamenEstudiante, 'url' => ['view', 'id' => $model->idExamenEstudiante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="examen-estudiante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
