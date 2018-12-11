<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

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
//                    return '<img src="http://market.firma-taurus.ru/'.$data->img.'" width="70">';
                    return Html::img($data->img,['width'=>150]);
                },
                'format' => 'html',
            ],
            'id',
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    $status  = $data->category;
                    return $status->name;
                },
            ],
            'name',
            'description:html',
            'keywords',
//            'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class="text-danger">Не опубликован</span>' : '<span class="text-success">Опубликован</span>';
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

<table class="table table-hover table-striped">
    <tr>
        <td>
            <?php $property  = $model->property; ?>
            <p>
                <?= Html::a('Создать характеристику', ['/property/create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Величина</th>
                        <th>Ед.измерения</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($property as $pro):?>
                        <tr>
                            <td><?=$pro['id']?></td>
                            <td><?=$pro['name']?></td>
                            <td><?=$pro['value']?></td>
                            <td><?=$pro['unit']?></td>
                            <td>
                                <a href="/property/view?id=<?=$pro['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="/property/update?id=<?=$pro['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/property/delete?id=<?=$pro['id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>

        </td>

        <td>


            <?php $comments  = $model->comments; ?>
            <p>
                <?= Html::a('Создать комментарий', ['/comments/create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Автор</th>
                        <th>Отзыв</th>
                        <th>E-mail</th>
                        <th>Дата</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($comments as $com):?>
                        <tr>
                            <td><?=$com['id']?></td>
                            <td><?=$com['user_name']?></td>
                            <td><?=$com['comment_text']?></td>
                            <td><?=$com['email']?></td>
                            <td><?=$com['comment_date']?></td>
                            <td>
                                <a href="/comments/view?id=<?=$com['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="/comments/update?id=<?=$com['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/comments/delete?id=<?=$com['id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>

        </td>
    </tr>
</table>

    <h3>Виды:</h3>
    <p>
        <?= Html::a('Создать вид', ['/image-products/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="container">
        <div class="row">

            <?php $items  = $model->imageProducts; ?>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Вид</th>
                        <th>Изображение</th>
                        <th>Цена</th>
                        <th>Остаток</th>
                        <th>Резерв</th>
                        <th>Скидка</th>
                        <th>Дата</th>
                        <th>Новинка</th>
                        <th>Хит</th>
                        <th>Распродажа</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item):?>
                        <tr>
                            <td><a href="/image-products/view?id=<?=$item['id']?>"><?=$item['name']?></a></td>
                            <td><img src="http://market.firma-taurus.ru/<?=$item['img']?>" width="70"></td>
                            <td><?=$item['price']?><span class="glyphicon glyphicon-rub"></span></td>
                            <td><?=$item['avalible']?>шт.</td>
                            <td><?=$item['reserv']?>шт.</td>
                            <td><?=$item['discount']?>%</td>
                            <td><?=$item['date']?></td>
                            <td><?php if($item['new'] == 1){echo 'да';}else{echo 'нет';}?></td>
                            <td><?php if($item['hit'] == 1){echo 'да';}else{echo 'нет';}?></td>
                            <td><?php if($item['sales'] == 1){echo 'да';}else{echo 'нет';}?></td>
                            <td><?php if($item['status'] == 1){echo '<span class="text-success">опубликован</span>';}
                            else{echo '<span class="text-danger">не опубликован</span>';}?></td>
                            <td>
                                <a href="/image-products/view?id=<?=$item['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="/image-products/update?id=<?=$item['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/image-products/delete?id=<?=$item['id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>


</div>
