<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MetaEnunciado */
/* @var $provider yii\data\ArrayDataProvider*/

$this->title = 'Importar';
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['/meta-enunciado']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre ,
    'url' => ['/meta-enunciado/view', 'id' => $model->idMetaEnunciado]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lote-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($provider->count==0){?>
    <p>Solo se aceptan archivos .csv de entre 2 y 11 columnas, sin las cabeceras.  La primer columna es el Atributo 1 (C1) y la última es la Respuesta Esperada. Columna 1 -> C1, Columna 2 -> C2 ... Columna última->Respuesta</p>
    <p>1,2,3,4,5,6,7,8,9,10,"Respuesta"</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelform, 'archivo')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Importar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php } else{?>
    <h3>Resumen</h3>
    <div class="alert alert-success">
        
        <?php        foreach ($contadores as $contador=>$cantidad){
        echo '<h4  >'.$cantidad.' '.$contador.'</h4>';
    }?>
        </div>
<h3>Certificados Importados</h3>
    <?=
    yii\grid\GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'c1',
            'c2',
            'c3',
            'Respuesta',
            'msj'],
    ]);
    ?>
    <?php }?>
</div>
