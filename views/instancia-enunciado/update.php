<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */

$this->title = 'Update Instancia Enunciado: ' . $model->idInstanciaEnunciado;
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['/meta-enunciado']];
$this->params['breadcrumbs'][] = ['label' => $model->idMetaEnunciado0->nombre, 'url' => ['/meta-enunciado/view','id'=>$model->idMetaEnunciado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instancia-enunciado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
