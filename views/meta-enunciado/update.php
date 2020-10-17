<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MetaEnunciado */

$this->title = 'Update Meta Enunciado: ' . $model->idMetaEnunciado;
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMetaEnunciado, 'url' => ['view', 'id' => $model->idMetaEnunciado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meta-enunciado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
