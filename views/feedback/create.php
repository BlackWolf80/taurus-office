<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = 'Создать отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">

   <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
