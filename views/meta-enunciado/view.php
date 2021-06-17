<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MetaEnunciado */

$this->title = $model->idMetaEnunciado. '-'. $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meta-enunciado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idMetaEnunciado], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->idMetaEnunciado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMetaEnunciado',
            'nombre',
            'enunciado:ntext',
        ],
    ])
    ?>
    <h2>Instancias</h2>
    <?= Html::a('Agregar', ['/instancia-enunciado/create', 'id' => $model->idMetaEnunciado], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Importar', ['importar', 'id' => $model->idMetaEnunciado], ['class' => 'btn btn-primary']) ?>
    <?=
    Html::a('Borrar Instancias', ['deleteinstancias', 'id' => $model->idMetaEnunciado], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Está seguro de borrar todas las instancias del meta-enunciado?',
            'method' => 'post',
        ],
    ])
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idInstanciaEnunciado',
            //'idMetaEnunciado',
            'instancia',
            'c1:ntext',
            'c2:ntext',
            'c3:ntext',
            'c4:ntext',
            'c5:ntext',
            //'c6:ntext',
            //'c7:ntext',
            //'c8:ntext',
            //'c9:ntext',
            //'c10:ntext',
            'respuesta:html',
            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                
                'urlCreator' => function($action, $model, $key, $index) {
                    /* if ($action == "update") {
                      return \yii\helpers\Url::to(['/certificado/view', 'id' => $key]);
                      } */
                    if ($action == "view") {
                        return \yii\helpers\Url::to(['/instancia-enunciado/view', 'id' => $model->idInstanciaEnunciado]);
                    }
                    if ($action == "update") {
                        return \yii\helpers\Url::to(['/instancia-enunciado/update', 'id' => $model->idInstanciaEnunciado]);
                    }
                    if ($action == "delete") {
                        return \yii\helpers\Url::to(['/instancia-enunciado/delete', 'id' => $model->idInstanciaEnunciado]);
                    }
                }],
        ],
    ]);
    ?>


</div>
