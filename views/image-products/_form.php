<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-products-form">

    <?php $form = ActiveForm::begin(); ?>

   <!-- <?= $form->field($model, 'id_prod')->textInput(['maxlength' => true]) ?>-->
    <?= $form->field($model, 'id_prod')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Products::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord){
            if(isset($_GET['int'])){
                echo $form->field($model, 'img')->textInput(['maxlength' => true,'value'=>$model->dir.'/'.$_GET['int']]);
            }
            else{
                echo $form->field($model, 'img')->textInput(['maxlength' => true]);
            }

            echo Html::a('Загрузить изображение',['/image-products/upload','id'=>$model->id],['class'=>'btn btn-success']);
        }
    ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'avalible')->textInput() ?>

    <?= $form->field($model, 'reserv')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <!--<?= $form->field($model, 'status')->textInput() ?>-->
    <!--<?= $form->field($model, 'status')->dropDownList([ '0' => 'Не опубликован', '1' => 'Опубликован',]) ?>-->
    <?= $form->field($model, 'status')->checkbox([ '0' => 'Нет', '1' => 'Да',]) ?>

   <!-- <?= $form->field($model, 'date')->textInput() ?> -->

   <!-- <?= $form->field($model, 'new')->textInput() ?> -->
    <?= $form->field($model, 'new')->checkbox([ '0' => 'Нет', '1' => 'Да',]) ?>

   <!-- <?= $form->field($model, 'hit')->textInput() ?>-->
    <?= $form->field($model, 'hit')->checkbox([ '0' => 'Нет', '1' => 'Да',]) ?>

   <!-- <?= $form->field($model, 'sales')->textInput() ?> -->
    <!--<?= $form->field($model, 'sales')->dropDownList([ '0' => 'Нет', '1' => 'Да',]) ?>-->
    <?= $form->field($model, 'sales')->checkbox([ '0' => 'Нет', '1' => 'Да',]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
