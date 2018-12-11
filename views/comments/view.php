<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title = $model->product->name;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/products/view', 'id' =>$model->product_id]];
$this->params['breadcrumbs'][] = 'Комментарий #'.$model->id;
?>
<div class="comments-view">

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
            'id',
            'product_id',
            'user_name',
            'comment_text:ntext',
            'email:email',
            'comment_date',
        ],
    ]) ?>

</div>
