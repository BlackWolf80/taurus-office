<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CardOperations */

$this->title = 'Create Card Operations';
$this->params['breadcrumbs'][] = ['label' => 'Card Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-operations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
