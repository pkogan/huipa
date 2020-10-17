<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEnunciado */

$this->title = 'Update Examen Enunciado: ' . $model->idExamenEnunciado;
$this->params['breadcrumbs'][] = ['label' => 'Examen Enunciados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamenEnunciado, 'url' => ['view', 'id' => $model->idExamenEnunciado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="examen-enunciado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
