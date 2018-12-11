<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImageProducts */

$this->title = 'Создать вид';
$this->params['breadcrumbs'][] = ['label' => 'Виды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
