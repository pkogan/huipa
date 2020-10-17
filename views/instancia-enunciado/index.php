<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstanciaEnunciadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instancia Enunciados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instancia-enunciado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Instancia Enunciado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idInstanciaEnunciado',
            'idMetaEnunciado',
            'c1:ntext',
            'c2:ntext',
            'c3:ntext',
            //'c4:ntext',
            //'c5:ntext',
            //'c6:ntext',
            //'c7:ntext',
            //'c8:ntext',
            //'c9:ntext',
            //'c10:ntext',
            //'respuesta:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
