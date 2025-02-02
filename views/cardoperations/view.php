<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CardOperations */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Card Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-operations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'card_number',
            'date',
//            'summ',
            [
                'attribute' => 'summ',
                'value' => function($data){
                    $result = '<span class = "text-danger"><b><h4>'.$data->summ.'<i class="glyphicon glyphicon-rub"></i></h4></b></span>';
                    return $result;
                },
                'format'=>'raw',
            ],
            'operation_type',
            'note',
        ],
    ]) ?>

</div>
