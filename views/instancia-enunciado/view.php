<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InstanciaEnunciado */

$this->title = $model->idInstanciaEnunciado;
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['/meta-enunciado']];
$this->params['breadcrumbs'][] = ['label' => $model->idMetaEnunciado0->nombre, 'url' => ['/meta-enunciado/view','id'=>$model->idMetaEnunciado]];

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instancia-enunciado-view">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <p><?= $model->instancia ?></p>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idInstanciaEnunciado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idInstanciaEnunciado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idInstanciaEnunciado',
            'idMetaEnunciado',
            'c1:ntext',
            'c2:ntext',
            'c3:ntext',
            'c4:ntext',
            'c5:ntext',
            'c6:ntext',
            'c7:ntext',
            'c8:ntext',
            'c9:ntext',
            'c10:ntext',
            'respuesta:ntext',
        ],
    ]) ?>

</div>
