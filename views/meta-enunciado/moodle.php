<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MetaEnunciado */
?>
<?xml version="1.0" encoding="UTF-8"?>
<quiz>
    <?php foreach ($model->instanciaEnunciados as $instancia): ?>
    <question type="numerical">
            <name>
                <text><?= Html::encode($model->nombre) ?></text>
            </name>
            <questiontext format="html">
                <text><![CDATA[<?= Html::encode($instancia->getInstancia()) ?>]]</text> 
            </questiontext>
            <generalfeedback format="html">
                <text></text>
            </generalfeedback>
            <defaultgrade>1.0000000</defaultgrade>
            <penalty>0.3333333</penalty>
            <hidden>0</hidden>
            <idnumber></idnumber>
            <answer fraction="100" format="moodle_auto_format">
                <text><?= str_replace('.','',substr($instancia->respuesta, stripos($instancia->respuesta, '=')==0?0:stripos($instancia->respuesta, '=')+1, strlen($instancia->respuesta))) ?></text>
                <tolerance>0</tolerance>
            </answer>
            <unitgradingtype>0</unitgradingtype>
            <unitpenalty>0.1000000</unitpenalty>
            <showunits>3</showunits>
            <unitsleft>0</unitsleft>
        </question>
    <?php endforeach; ?>
</quiz>