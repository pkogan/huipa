<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MetaEnunciado */

$this->title = 'Create Meta Enunciado';
$this->params['breadcrumbs'][] = ['label' => 'Meta Enunciados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-enunciado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
