<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Examen */
/* @var $provider yii\data\ArrayDataProvider*/

$this->title = 'Importar Estudiantes';
$this->params['breadcrumbs'][] = ['label' => 'Examenes', 'url' => ['/examen']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre,
    'url' => ['/examen/view', 'id' => $model->idExamen]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lote-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($provider->count==0){?>
    <p>Solo se aceptan archivos .csv de dos columnas, sin las cabeceras.  Columna 1 -> mail</p>
    <p>Opcionales se pueden agregar las columnas Columna 2 -> Apellido y Nombre, Columna 3 -> dni, Columna 4 -> legajo en el caso de importar Personas Nuevas, (si es un alta: dni y legajo opcionales)</p>
    <p>"pepe@fi.uncoma.edu.ar","Parada Pepe",12345678,"FAI-123"</p>
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
            'mail',
            'msj'],
    ]);
    ?>
    <?php }?>
</div>
