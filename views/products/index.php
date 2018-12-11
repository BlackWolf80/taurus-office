<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Создать продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            ['class' => \yii\grid\CheckboxColumn::className()],

//            'id',
            [

                'attribute' => 'id',
                'value' => function($data){
                    return '<a href="/products/view?id=' .$data->id. '">' .$data->id. '</a>';
                },
                'format' => 'html',
            ],
//            'name',
            [

                'attribute' => 'name',
                'value' => function($data){
                    return '<a href="/products/view?id=' .$data->id. '">' .$data->name. '</a>';
                },
                'format' => 'html',
            ],
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    $status  = $data->category;
                    return $status->name;
                },
            ],
            [
                'attribute' => 'img',
                'value' =>function($data){
                    return Html::img($data->img,['width'=>150]);
                },
                'format' => 'html',
            ],
//            'description:ntext',
            // 'keywords',
//             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ?
                        '<span class = "
">Не опубликовано</span>' :
                        '<span class = "text-success">Опубликовано</span>';
                },
                'format'=>'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
