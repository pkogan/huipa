<?php

/* @var $this yii\web\View */

$this->title = 'huipa - Generador de enunciados aleatorios';
$examenestudiante= app\models\ExamenEstudiante::findOne(['hash' => 'c94a8bae8e6da624df902f58b40c782b']);
if(is_null($examenestudiante)){
    $link='';
}else{
    $link=$examenestudiante->getLink();
}
?>
<div class="site-index">

    <div class="jumbotron">
        
        <h1>Bienvenidos a <img src="img/huipa.png"></h1>

        <p class="lead">El sistema de generación de enunciados aleatorios de la Facultad de Informática de la Universidad Nacional del Comahue.</p>

        <p><a class="btn btn-lg btn-success" href="<?= $link ?>">Ver ejemplo de Examen</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Que es huipa?</h2>

                <p>Es un generador de examenes únicos en formato pdf.  A partir de un Meta-enunciado, con variables y una generación de posibles instancias,
                    genera un documento único para cada estudiante y lo envia por mail</p>

                <p><a class="btn btn-default" href="<?= $link ?>">Ver ejemplo de Examen &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Historia</h2>

                <p>Huipa es desarrollado durante el periodo de aislamiento provocado por el COVID19 en la cátedra de Elementos de Teoría de la computación
                    de la Facultad de Informatica de la Universidad Nacional del Comahue, con el objetivo de generar una propuesta de exámen único para cada estudiante.</p>

                <p>Esta basado en dos sistemas <a class="btn btn-default" href="http://hornero.fi.uncoma.edu.ar/">hornero &raquo;</a> y 
                <a class="btn btn-default" href="http://wene.fi.uncoma.edu.ar/">wene &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Como se utiliza?</h2>
                <ul>
                    <li>Registro de usuario - En desarrollo </li>
                    <li>Generanción de meta-enunciados con comodines como variables</li>
                    <li>Generación/Importación del pool de valores que puede tener cada variable</li>
                    <li>Creación del Examen</li>
                    <li>Selección de meta-enunciados</li>
                    <li>Importar/Cargar Estudiantes</li>
                    <li>Asignación aleatoria y automática de instancias de Examen</li>
                    <li>Validar consistencia de instancias de Examen</li>
                    <li>Envio automático de exámenes únicos por mail</li>
                    
                </ul>
                
            </div>
        </div>

    </div>
</div>
