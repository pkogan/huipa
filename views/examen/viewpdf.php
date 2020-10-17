<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Examen */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Examens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="examen-view">

    <h1><?= 'Examen '.Html::encode($this->title) ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idExamen',
            'nombre',
            'descripcion:ntext',
            'fecha',
            //'idTemplate',
        ],
    ]) ?>

</div>
