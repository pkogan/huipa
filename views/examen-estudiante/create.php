<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudiante */

$this->title = 'Agregar Estudiante a Examen';
$this->params['breadcrumbs'][] = ['label' => 'Examenes', 'url' => ['/examen']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamen0->nombre, 'url' => ['/examen/view','id'=>$model->idExamen]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examen-estudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
