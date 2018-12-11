<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">





    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
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
        echo Html::a('Загрузить изображение',['/products/upload','id'=>$model->id],['class'=>'btn btn-success']);
    }

    ?>

    <br /><br />

    <?php

    echo $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);

    ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox([ '0' => 'Не опубликован', '1' => 'Опубликован',]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
