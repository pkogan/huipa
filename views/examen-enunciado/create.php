<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEnunciado */

$this->title = 'Agregar Meta Enunciado a Examen';
$this->params['breadcrumbs'][] = ['label' => 'Examenes', 'url' => ['/examen']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamen0->nombre, 'url' => ['/examen/view','id'=>$model->idExamen]];
$this->params['breadcrumbs'][] = $this->title;
$_SESSION['idExamen']=$model->idExamen;
?>
<div class="examen-enunciado-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
        <?=    \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idMetaEnunciado',
            'nombre',
            'enunciado:ntext',
            'descripcion',
            'CantidadExamenes',
            'CantidadInstancias',

            //['class' => 'yii\grid\ActionColumn'],
            
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                    'title' => Yii::t('yii', 'Agregar'),
                                    'data' => [
                'confirm' => 'Esta seguro de Agregar en enuciado?',
                'method' => 'post',
            ],
                            
                        ]);
                    },
                ],
                'urlCreator' => function( $action, $model, $key, $index ) {
                    /* if ($action == "update") {
                      return \yii\helpers\Url::to(['/certificado/view', 'id' => $key]);
                      } */
                    if ($action == "add") {
                        return \yii\helpers\Url::to(['/examen-enunciado/create','id'=>$_SESSION['idExamen'], 'idMetaEnunciado' => $model->idMetaEnunciado]);
                    }
                }],
            
            
        ],
    ]); ?>

</div>
