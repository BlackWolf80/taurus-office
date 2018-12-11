<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title =  $model->product->name;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/products/view', 'id' =>$model->product_id]];
$this->params['breadcrumbs'][] = ['label' => 'Комментарий #'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
