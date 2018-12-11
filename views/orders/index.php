<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <!--<h1><?= Html::encode($this->title) ?></h1> -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [

                'attribute' => 'id',
                'value' => function($data){
                return '<a href="/orders/view?id=' .$data->id. '">' .$data->id. '</a>';
                },
                'format' => 'html',
            ],
            'name',
            'last_name',
//            'address:ntext',
            'phone',
             'email:email',
             'created_at',
//             'updated_at',
            [
                'attribute' => 'debit',
                'value' => function($data){

                    if($data->debit == 1) {$result='<span class = "text-success">Произведена</span>';}
                    elseif ($data->debit == 2){$result='<span class = "text-danger">Отказано</span>';}
                    elseif ($data->debit == 3){$result='<span class = "text-danger">Возврат</span>';}
                    else{$result='<a href="/orders/update?id=' .$data->id. '">' .
                        '<span class = "text-danger">Не производилась</span>'. '</a>';}
                    return $result;
                },
                'format'=>'raw',
            ],
//             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    $status  = $data->orderStatus;
                    return $status->name;
                },

            ],

            // 'qty',
             'sum',
//             'card_id',
            [
                'attribute' => 'card_id',
                'value' => function($data){
                    return !$data->card_id ? 'нет' : $data->card_id;
                },
            ],
             'points',
//             'discount',
            [
                'attribute' => 'discount',
                'value' => function($data){
                    return !$data->discount ? 'нет' : $data->discount;
                },
            ],
            [
                'attribute' => 'summary',
                'value' => function($data){

                    $it = $data->sum - $data->discount - $data->points;
                    return $it;
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
