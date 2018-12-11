<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['/products/index']];
$this->params['breadcrumbs'][] = ['label' => 'Виды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->products->name, 'url' => ['/products/view', 'id' =>$model->products->id]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            [
                'attribute' => 'img',
                'value' =>function($data){
                    return '<img src="http://market.firma-taurus.ru/'.$data->img.'" width="70">';
                },
                'format' => 'html',
            ],
            'id',
//            'id_prod',
            [

                'attribute' => 'id_prod',
                'value' => function($data){
                    return '<a href="/products/view?id=' .$data->id_prod. '">' .$data->products->name. '</a>';
                },
                'format' => 'html',
            ],
            'name',
//            'img',
//            'price',
            [
              'attribute' => 'price',
              'value' => function($data){
                  return $data->price. '<span class="glyphicon glyphicon-rub"></span>';
              },
                'format' => 'html',
            ],
            'avalible',
            'reserv',
            'discount',
//            'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class="text-danger">Не опубликован</span>' : '<span class="text-success">Опубликован</span>';
                },
                'format' => 'html',
            ],
            'date',
//            'new',
            [
                'attribute' => 'new',
                'value' => function($data){
                    return !$data->new ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
//            'hit',
            [
                'attribute' => 'hit',
                'value' => function($data){
                    return !$data->hit ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
//            'sales',
            [
                'attribute' => 'sales',
                'value' => function($data){
                    return !$data->sales ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
