<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CardOperations */

$this->title = 'Update Card Operations: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Card Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card-operations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
