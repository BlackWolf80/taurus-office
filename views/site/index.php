<?php
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">





    <table>
        <tr>
            <td>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th colspan="5"><a href="<?=\yii\helpers\Url::to('orders')?>">Заказы</a></th>
                        </tr>
                        <tr>
                            <th>Обработка</th>
                            <th>Формирование</th>
                            <th>Оплаченные</th>
                            <th>Отгруженные</th>
                            <th>Отказы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $ord0; ?></td>
                            <td><?php echo $ord1; ?></td>
                            <td><?php echo $ord2; ?></td>
                            <td><?php echo $ord3; ?></td>
                            <td><?php echo $ord4; ?></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th><a href="<?=\yii\helpers\Url::to('callback')?>">Звонки</a></th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $calls; ?></td>
                        </tr>
                        </tbody>
                    </table>

                </div>



            </td>
        </tr>
    </table>





    <div class="body-content">

        <div class="row">

        </div>

    </div>
</div>
