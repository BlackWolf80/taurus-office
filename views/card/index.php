<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Дисконтные карты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cards-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Сгенерировать карту', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'username',
            [
                'attribute' => 'username',
                'value' => function($data){
                    return Html::a('<h4>' .$data->username. '</a></h4>',['/card/view','id'=>$data->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'points',
                'value' => function($data){
                    $result = '<span class = "text-danger"><h4>'.$data->points.'<i class="glyphicon glyphicon-rub"></i></h4></span>';
                    return $result;
                },
                'format'=>'raw',
            ],
            'last_name',
            'name',
            'phone',
            'email:email',
            'address:ntext',
//             'points',
            // 'password',
            // 'auth_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
