<?php
use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>


<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]);
    ?>

    <?= $form->field($model, 'file')->fileInput(); ?>

    <button>Загрузить</button>
<br /><br /><br />
<?php ActiveForm::end(); ?>


<?php  for ($i = 0; $i < count($files); $i++) { ?>


    <?=Html::a(Html::img($dirShow.'/'.$files[$i],['width'=>150]),['products/update','id'=>$_GET['id'],'int'=>$files[$i]])?>
        <?=Html::a('<i class="glyphicon glyphicon-remove btn-danger"></i>',['products/upload','id'=>$_GET['id'],'del'=>$files[$i]]);?>&nbsp;&nbsp;



    <?php if (($i + 1) % 4 == 0) { ?><br /><br /><?php } ?>
<?php } ?>
