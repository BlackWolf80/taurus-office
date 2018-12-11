<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

   <!-- <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'parent_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(),'id','name')) ?>-->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <<?php
    if($model->isNewRecord){

    }
    else{



        if(isset($_GET['int'])){
            echo $form->field($model, 'img')->textInput(['maxlength' => true,'value'=>$model->dir.'/'.$_GET['int']]);
        }
        else{
            echo $form->field($model, 'img')->textInput(['maxlength' => true]);
        }


        //echo Html::a('Загрузить изображение',['/products/upload','id'=>$model->id],['taget'=>'_blank','onclick'=>"window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=400,height=400'); return false;"]);
        echo Html::a('Загрузить изображение',['/categories/upload','id'=>$model->id],['class'=>'btn btn-success']);
    }

    ?>



    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
