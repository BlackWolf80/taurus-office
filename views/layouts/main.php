<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <header>
        <div class="container">
            <div class="row header_top1">
                <div class="logo col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="<?=\yii\helpers\Url::to('/'); ?>"><img src="images/logo_office.png"></a>
                </div>
                <div class="btn_top_wrap col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="center-block write_email">
                        <h2>Интерфейс менеджера</h2>

                    </div>

                </div>
            </div>
        </div>
<div class="container">
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Таурус - office',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Главная', 'url' => ['/site/index']],
                    ['label' => 'Заказы', 'url' => ['/orders/']],

                    ['label' => 'Продукция',

                        'items' => [
                            ['label' => 'Продукты', 'url' => ['/products/index']],
                            ['label' => 'Виды продуктов', 'url' => ['/image-products/index']],
                            ['label' => 'Категории', 'url' => ['/categories/index']],

                        ],

                    ],

                    ['label' => 'Дисконтные карты', 'url' => ['/cards/']],
                    ['label' => 'Новости', 'url' => ['/news/']],
                    ['label' => 'Отзывы', 'url' => ['/feedback/']],
                    ['label' => 'Заказ звонка', 'url' => ['/callback/']],
                    ['label' => 'Нижнее меню', 'url' => ['/publications/']],

                    Yii::$app->user->isGuest ? (
                    ['label' => 'Авторизация', 'url' => ['/site/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выход (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ],
            ]);
            NavBar::end();
            ?>
        </div>
</div>
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>



    </header>


    <!-------------------------------------------------- -->
    <?= $content ?>
    <!-------------------------------------------------- -->


    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 copy">
                    <p>© ООО "Таурус"  2017</p>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>