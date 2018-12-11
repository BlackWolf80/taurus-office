
 <div id="print_page">
        <div class='imgblock'>
            <img src="./images/top.png" width="100%">


            <div class="data_sert">

                <ul>
                    <li>№:<?=$operation->id?></li>
                    <li>от: <?=$operation->date?></li>
                </ul>

                <?=$operation->card->last_name.'  '.$operation->card->name?><br />
                НА СУММУ: <?=$operation->summ?> ₽</i>

            </div>

            <img class="bottom" src="./images/bottom.png" width="100%">
        </div>
    </div>