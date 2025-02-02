<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Callback */

$this->title = 'Обратный звонок №: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказ звонка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callback-view">

   <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'name',
            'phons',
//             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ?
                        '<span class = "text-danger">Ожидает</span>' :
                        '<span class = "text-success">Позвонили</span>';
                },
                'format'=>'raw',
            ],
        ],
    ]) ?>

</div>
