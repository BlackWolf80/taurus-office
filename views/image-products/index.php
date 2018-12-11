<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды продуктов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-products-index">

 <!--   <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
//            'id_prod',
            [

                'attribute' => 'id_prod',
                'value' => function($data){
                    return '<a href="/products/view?id=' .$data->id_prod. '">' .$data->products->name. '</a>';
                },
                'format' => 'html',
            ],
//            'name',
            [

                'attribute' => 'name',
                'value' => function($data){
                    return '<a href="/image-products/view?id=' .$data->id. '">' .$data->name. '</a>';
                },
                'format' => 'html',
            ],
            'img',
            'price',
             'avalible',
             'reserv',
             'discount',
             'status',
             'date',
             'new',
             'hit',
             'sales',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
