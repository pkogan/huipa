<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */

$this->title = 'Crear Instancia Enunciado';
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['/meta-enunciado']];
$this->params['breadcrumbs'][] = ['label' => $model->idMetaEnunciado0->nombre, 'url' => ['/meta-enunciado/view','id'=>$model->idMetaEnunciado]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instancia-enunciado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
