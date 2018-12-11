<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cards */

$this->title = 'Сгенерировать карту';
$this->params['breadcrumbs'][] = ['label' => 'Дисконтные карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cards-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
