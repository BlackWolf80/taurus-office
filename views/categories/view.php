<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                    return  Html::img($data->img,['width'=>'300']);
                },
                'format' => 'html',
            ],
            'description:html',
            'keywords',
        ],
    ]) ?>

</div>
