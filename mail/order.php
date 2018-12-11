
<table>
    <tr>
        <td colspan="2"><?php echo 'Здравствуйте '.$order->last_name.'  '.$order->name. '<br>';?></td>
    </tr>
    <tr><td colspan="2"><?php echo 'Статус вашего заказа №  <b>'.$order->id.'</b> в Taurus-market изменен на:  '.$order->orderStatus->name;?></td></tr>
</table>

<div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Цвет</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($session as $item):?>
                    <td><?= $item['prod']?></td>
                    <td><?= $item['name']?></td>
                    <td><?= $item['qty']?> шт.</td>
                    <td><?= $item['price']?><span class="glyphicon glyphicon-rub"></span></td>
                    <td><?= $item['price'] * $item['qty']?> руб.</td>
                </tr>
            <?php endforeach?>
            <tr>
                <td colspan="5">Итого: </td>
                <td><?= $order->qty?> товар(ов)</td>

            </tr>
            <tr>
                <td colspan="5">На сумму: </td>
                <td><?= $order->sum?> руб.</td>
            </tr>
            </tbody>
        </table>
    </div>

<?='С уважением администрация  <a href="market.taurus-plastik.ru">Таурус-market</a><br>'?>

