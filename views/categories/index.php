<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'parent_id',
//            [
//                'attribute' => 'parent_id',
//                'value' => function($data){
//                    $Category  = $data->category;
//                    return $Category['name'];
//                },
//                'format'=>'raw',
//            ],
            'name',
//            'img',
            [
                'attribute' => 'img',
                'value' =>function($data){
                    return  Html::img($data->img,['width'=>'70']);
                },
                'format' => 'html',
            ],

            'description:html',
             'keywords',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
