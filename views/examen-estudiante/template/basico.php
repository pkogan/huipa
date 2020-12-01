<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\ExamenEstudiante */
?>
<!-- <div class="row" style="text-align: center" >
            <img  width="30%" src="img/faif.png" alt="Facultad de Informática"/></div>-->
    

    <h1><?= Html::encode($model->idExamen0->nombre) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'idExamenEstudiante',
//            'idExamen',
//            'idEstudiante',
            //['label'=>'Examen','value'=>$model->idExamen0->nombre],
            ['label'=>'Fecha','value'=>$model->idExamen0->fecha],
            ['label'=>'Estudiante','value'=>$model->idEstudiante0->apellidoNombre],
            ['label'=>'Mail','value'=>$model->idEstudiante0->mail],
            ['label'=>'Legajo','value'=>$model->idEstudiante0->legajo],
            //['label'=>'DNI','value'=>$model->idEstudiante0->dni],
            ['label'=>'Descripción','value'=>$model->idExamen0->descripcion],
            //'hash',
           /* ['label'=>'Validar','value'=>'Accediendo al siguiente código QR se puede validar el certificado. '.
                'Si no tienen lector de códigos QR el certificado se puede validar entrando a '.\yii\helpers\Url::base('https').' con el código '.$model->hash],
                 //'<a href="'.\yii\helpers\Url::base('https').'">'.\yii\helpers\Url::base('https').'</a> con el código <b>'.$model->hash.'</b>'],*/
            ['label' => 'QR', 'value' => $qrCode->writeDataUri(), 'format' => ['image', []]],
        ],
    ]) 
        ?>
    <h2>Ejercicios</h2>
    <?php
    $i=1;
        foreach ($model->examenEstudianteInstancias as $examenEstudianteIntancia){
            echo '<b>Ejercicio '.$i++.' - '.$examenEstudianteIntancia->idInstanciaEnunciado0->idMetaEnunciado0->nombre.'</b>';
            echo '<p>'.$examenEstudianteIntancia->idInstanciaEnunciado0->instancia.'</p>';
            if(isset($respuesta)&&$respuesta){
                echo '<p><b>Corrección:</b>'.$examenEstudianteIntancia->idInstanciaEnunciado0->respuesta.'</p>';
            }
        }
        ?>
    


