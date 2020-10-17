<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Examen */

$this->title = 'Update Examen: ' . $model->idExamen;
$this->params['breadcrumbs'][] = ['label' => 'Examens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamen, 'url' => ['view', 'id' => $model->idExamen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="examen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
