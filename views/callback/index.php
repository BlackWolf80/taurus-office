<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказ звонка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callback-index">

   <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Создать звонок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phons',
//             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ?

                        '<a href="/callback/update?id=' .$data->id. '">' .'<span class = "text-danger">Ожидает</span>'. '</a>'
                        :
                        '<span class = "text-success">Позвонили</span>';
                },
                'format'=>'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
