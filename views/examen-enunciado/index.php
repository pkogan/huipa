<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExamenEnunciadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Examen Enunciados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examen-enunciado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Examen Enunciado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idExamenEnunciado',
            'idExamen',
            'idMetaEnunciado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
