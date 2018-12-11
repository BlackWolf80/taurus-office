<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProducts */

$this->title = 'Редактирование вида: "' . $model->name .'" продукта - '.$model->products->name;
$this->params['breadcrumbs'][] = ['label' => 'Виды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->products->name, 'url' => ['/products/view', 'id' =>$model->products->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="image-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
