<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Examen */

$this->title = $model->idExamen;
$this->params['breadcrumbs'][] = ['label' => 'Examens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="examen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idExamen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idExamen], [
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
            'idExamen',
            'nombre',
            'descripcion:ntext',
            'fecha',
            ['label'=>'Iniciados','value'=>$model->getCountExamenesEstudiantes(\app\models\Estado::ESTADO_INICIAL)],
            ['label'=>'Asignado','value'=>$model->getCountExamenesEstudiantes(\app\models\Estado::ESTADO_ASIGNADO)],
            ['label'=>'Enviados','value'=>$model->getCountExamenesEstudiantes(\app\models\Estado::ESTADO_ENVIADO)],
            //['label'=>'Recibidos','value'=>$model->getCountExamenesEstudiantes(\app\models\Estado::ESTADO_RECIBIDO)],
            ['label'=>'Total','value'=>$model->getCountExamenesEstudiantes()]
            
        ],
    ]) ?>
    
    <h2>Enunciados</h2>
    <?= Html::a('+ Enunciado', ['/examen-enunciado/create', 'id' => $model->idExamen], ['class' => 'btn btn-primary']) ?>
     <?= GridView::widget([
        'dataProvider' => $dataProviderEnunciado,
        'filterModel' => $searchModelEnunciado,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idExamenEnunciado',
            //'idExamen',
            'idMetaEnunciado0.nombre',
            'idMetaEnunciado0.enunciado',
            'idMetaEnunciado0.CantidadExamenes',
            'idMetaEnunciado0.CantidadInstancias',

            //['class' => 'yii\grid\ActionColumn'],
            
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                
                'urlCreator' => function( $action, $model, $key, $index ) {
                    /* if ($action == "update") {
                      return \yii\helpers\Url::to(['/certificado/view', 'id' => $key]);
                      } */
                    if ($action == "view") {
                        return \yii\helpers\Url::to(['/examen-enunciado/view', 'id' => $model->idExamenEnunciado]);
                    }
                    if ($action == "update") {
                        return \yii\helpers\Url::to(['/examen-enunciado/update', 'id' => $model->idExamenEnunciado]);
                    }
                    if ($action == "delete") {
                        return \yii\helpers\Url::to(['/examen-enunciado/delete', 'id' => $model->idExamenEnunciado]);
                    }
                }],
            
            
            
        ],
    ]); ?>
    
    
    <h2>Estudiantes</h2>
    <?= Html::a('1-Importar', ['importarestudiantes', 'id' => $model->idExamen], ['class' => 'btn btn-success']) ?>
    <?= Html::a('+ Estudiante', ['/examen-estudiante/create', 'id' => $model->idExamen], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Borrar Estudiantes', ['deleteestudiantes', 'id' => $model->idExamen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de borrar todxs lxs estudiantes del examen?',
                'method' => 'post',
            ],
        ]) ?>
    
    
    
       <?= Html::a('2-Asignar Instancias', ['asignarinstancias', 'id' => $model->idExamen], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Está seguro de Asignar Intancias (este proceso borrará instancias actuales)?',
                'method' => 'post',
            ],
        ]) ?>
    <?= Html::a('Borrar Instancias', ['deleteinstancias', 'id' => $model->idExamen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de borrar todas las instancias del examen?',
                'method' => 'post',
            ],
        ]) ?>
       <?php
       $inicial=$model->getCountExamenesEstudiantes(\app\models\Estado::ESTADO_ASIGNADO);
        if($inicial> app\models\Examen::TOPE_MAIL_LOTE){
            $msj=app\models\Examen::TOPE_MAIL_LOTE. ' de '.$inicial;
        }else{
            $msj=$inicial;
        }
       echo Html::a('3.1-Test Envío', ['/examen-estudiante/maillote', 'id' => $model->idExamen,'test'=>1], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Está seguro de enviar de test a ' . $msj . ' personas con examenes en estado asignado?',
                'method' => 'post',
            ],
        ]).' ';
       echo Html::a('3.2-Enviar', ['/examen-estudiante/maillote', 'id' => $model->idExamen], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Está seguro de enviar mail a ' . $msj . ' personas con examenes en estado asignado?',
                'method' => 'post',
            ],
        ]) ?>    
       <?= Html::a('Borrar Envio', ['deleteenvio', 'id' => $model->idExamen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de borrar el envio de todos',
                'method' => 'post',
            ],
        ]) ?>
       <?= Html::a('Descargar Exámenes (Emitidos)', ['download', 'id' => $model->idExamen], ['class' => 'btn btn-primary']);?>
 
    
        <?= GridView::widget([
        'dataProvider' => $dataProviderEstudiante,
        'filterModel' => $searchModelEstudiante,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idExamenEstudiante',
            //'idExamen',
            ['label' => 'Estudiante', 'attribute' => 'apellidoNombre', 'value' => 'idEstudiante0.apellidoNombre'],
            ['label' => 'mail', 'attribute' => 'mail', 'value' => 'idEstudiante0.mail'],
            ['label' => 'legajo', 'attribute' => 'legajo', 'value' => 'idEstudiante0.legajo'],
 ['attribute' => 'idEstado',
                'label' => 'Estado',
                'value'=>'idEstado0.estado',
                'filter' => [
                    \app\models\Estado::ESTADO_INICIAL => 'Inicial',
                    \app\models\Estado::ESTADO_ASIGNADO => 'Asignado',
                    \app\models\Estado::ESTADO_ENVIADO => 'Enviado',
                    \app\models\Estado::ESTADO_RECIBIDO => 'Recibido'
                ]],
            
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {download} {mail}',
                'buttons' => [
                    'download' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-download"></span>', $url, [
                                    'title' => Yii::t('yii', 'Descargar'),
                        ]);
                    },
                    'mail' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-send"></span>', $url, [
                                    'title' => Yii::t('yii', 'Enviar Mail'),
                                    'data' => [
                                        'confirm' => 'Está seguro de envíar mail a ' . $model->idEstudiante0->mail,
                                    //'method' => 'post',
                                    ],
                        ]);
                    }
                ],
                'urlCreator' => function( $action, $model, $key, $index ) {
                    /* if ($action == "update") {
                      return \yii\helpers\Url::to(['/certificado/view', 'id' => $key]);
                      } */
                    if ($action == "view") {
                        return \yii\helpers\Url::to(['/examen-estudiante/view', 'hash' => $model->hash]);
                    }
                    if ($action == "download") {
                        return \yii\helpers\Url::to(['/examen-estudiante/view', 'hash' => $model->hash, 'pdf' => true]);
                    }
                    if ($action == "mail") {
                        return \yii\helpers\Url::to(['/examen-estudiante/mail', 'hash' => $model->hash]);
                    }
                }],
            
            
        ],
    ]); ?>

</div>
