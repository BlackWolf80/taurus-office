<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CardOperationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Журнал операций по картам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-operations-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?//=\app\controllers\debug($searchModel)?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            'id',
            'date',
            'card_number',

//            'summ',
            [
                'attribute' => 'summ',
                'value' => function($data){
                    $result = $data->summ.'<i class="glyphicon glyphicon-rub"></i>';
                    return $result;
                },
                'format'=>'raw',
            ],
            'operation_type',
            'note',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
