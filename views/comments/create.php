<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title = 'Создать комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['/products/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
