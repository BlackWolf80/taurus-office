<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */


$this->title = 'Заказ №  '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>-->


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
            [
                'attribute' => 'debit',
                'value' => function($data){

                    if($data->debit == 1) {$result='<span class = "text-success">Произведена  (товар списан с резерва)</span>';}
                    elseif ($data->debit == 2){$result='<span class = "text-danger">Отказано</span>';}
                    elseif ($data->debit == 3){$result='<span class = "text-danger">Возврат</span>';}
                    else{$result='<span class = "text-danger">Не производилась</span>';}
                    return $result;

                },
                'format'=>'raw',
            ],
            'name',
            'last_name',
            //'address:html',
            ['attribute' => 'address',
             'value' =>  function($data){
                    $address  = '<a href="https://yandex.ru/maps/?mode=search&text='
                        .$data->address.'" target="_blank">'.$data->address.'</a>';
                    return $address;
                    },
                'format'=>'raw',

            ],
            'phone',
            'email:email',
            'created_at',
            'updated_at',
//             'status',
             [
                'attribute' => 'status',
                'value' => function($data){
                    $status  = $data->orderStatus;
                    return $status->name;
                },
                'format'=>'raw',
            ],
            'qty',
            'sum',
            'card_id',
            'points',
            'discount',
        ],
    ]) ?>
<h3>Подробно:</h3>
    <div class="container">
        <div class="row">

            <?php $items  = $model->order_products; ?>

            <div class="table-responsive txt_center">
                <table class="table table-hover table-striped ">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Цвет</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item):?>
                        <tr>
                            <td><img src="http://market.taurus-plastik.ru/<?=$item['img']?>" width="70"></td>
                            <td><?=$item['prod']?></td>
                            <td><?=$item['name']?></td>
                            <td><?=$item['qty']?></td>
                            <td><?=$item['price']?><span class="glyphicon glyphicon-rub"></span></td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>



</div>
