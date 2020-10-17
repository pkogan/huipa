<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Acerca de';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Los repositorio de fuentes disponibles en:
    </p>

    <code><a href="https://github.com/pkogan/huipa">https://github.com/pkogan/huipa</a></code>
</div>
