<?php

namespace app\controllers;

use app\models\Callback;
use app\models\Orders;
use Yii;
use yii\web\Response;
use app\models\LoginForm;
use app\models\UploadForm;
use yii\web\UploadedFile;


class SiteController extends AppController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   //заказ звонков
        $calls=0;
        $callback = Callback::find()->all();
        foreach ($callback as $value){
            if ($value->status == 0){$calls++;}
        }

        $ord0=$ord1=$ord2=$ord3=$ord4=0;
        $orders = Orders::find()->all();
        foreach ($orders as $value){
            if($value->status ==0) {$ord0++;}
            elseif ($value->status ==1){$ord1++;}
            elseif ($value->status ==2){$ord2++;}
            elseif ($value->status ==3){$ord3++;}
            elseif ($value->status ==4){$ord4++;}

        }



        $this->setMeta('Таурус office');
        return $this->render('index',compact(['calls','ord0','ord1','ord2','ord3','ord4']));

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
