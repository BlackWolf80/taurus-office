<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Cards */

$this->title = 'Карта №: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Дисконтные карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cards-view">

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
    <hr width="100%">
    <h4>Списание средств</h4><br />

    <div class="cards-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'points')->textInput(['value'=> 0]) ?>
        <?= Html::submitButton( 'Списать', ['class' => 'btn btn-success' ]) ?>
        <?php ActiveForm::end(); ?>

    </div>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'username',
//            'points',
            [
                'attribute' => 'points',
                'value' => function($data){
                    $result = '<span class = "text-danger"><b><h1>'.$data->points.'<i class="glyphicon glyphicon-rub"></i></h1></b></span>';
                    return $result;
                },
                'format'=>'raw',
            ],
            'name',
            'last_name',
            'phone',
            'email:email',
            'address:ntext',

//            'password',
//            'auth_key',
        ],
    ]) ?>

</div>


<h2>Операции по карте</h2>

<?= GridView::widget([
    'dataProvider' => $operationList,
    'columns' => [
        'id',
        'date',
        ['attribute' => 'summ',
            'value' => function($data){
                $result = $data->summ.'<i class="glyphicon glyphicon-rub"></i>';
                return $result;
            },
            'format'=>'raw',
        ],
        'operation_type',
        'note',
        ['attribute' => 'Бланк',
            'value' => function($data){
                if($data->print == 0){
                    $button = Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> Распечатать', ['/card/print','id'=> $data->id], [
                        'class'=>'btn btn-danger',
                        'target'=>'_blank',
                        'data-toggle'=>'tooltip',
                        'title'=>'Will open the generated PDF file in a new window',
                        'onclick' => 'window.location.reload(true)',
                    ]);
                }
                else{
                    $button = 'Распечатан';
                }

                return $button;
            },
            'format'=>'raw',

        ],
    ],
]); ?>