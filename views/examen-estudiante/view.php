<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudiante */

$this->title = $model->idExamen0->nombre;//.' - '.$model->idEstudiante0->apellidoNombre;
if(!Yii::$app->user->isGuest){
$this->params['breadcrumbs'][] = ['label' => "Exámenes", 'url' => ['/examen']];
$this->params['breadcrumbs'][] = ['label' => $model->idExamen0->nombre, 'url' => ['/examen/view','id'=>$model->idExamen]];
$this->params['breadcrumbs'][] = $model->idEstudiante0->apellidoNombre;

}else{
    $this->params['breadcrumbs'][] = $model->idExamen0->nombre.' / '.$model->idEstudiante0->apellidoNombre;
}

\yii\web\YiiAsset::register($this);
?>
<div class="examen-estudiante-view">

    <p>
        <?= Html::a('Descargar PDF', ['view', 'hash' => $model->hash, 'pdf'=>true], ['class' => 'btn btn-primary']) ?>
        <?php
        if(!Yii::$app->user->isGuest){
         echo Html::a('Delete', ['delete', 'id' => $model->idExamenEstudiante], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} ?>
    </p>

    <?= $this->render('template/basico', [
        'model'=>$model,
        'qrCode'=>$qrCode,
    ])?>
    


</div>
