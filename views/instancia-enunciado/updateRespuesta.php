<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */

$this->title = 'Actualizar Respuesta de Instancia Enunciado: ' . $model->idInstanciaEnunciado;
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['/meta-enunciado']];
$this->params['breadcrumbs'][] = ['label' => $model->idMetaEnunciado0->nombre, 'url' => ['/meta-enunciado/view','id'=>$model->idMetaEnunciado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instancia-enunciado-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= $model->instancia ?></p>
    <?= $this->render('_formRespuesta', [
        'model' => $model,
    ]) ?>

</div>
