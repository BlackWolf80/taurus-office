<?php

namespace app\controllers;

use app\models\Cards;
use app\models\ImageProducts;
use app\models\OrderProducts;
use Yii;
use app\models\Orders;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $section = ['index', 'view','create','update','delete',''];
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => $section,
                'rules' => [
                    [
                        'actions' => $section,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find()->with(['order_products']),
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort'=>[
                'defaultOrder'=>[
                    'status'=>SORT_ASC
                ]],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function setStatus($status, $debit, $model_id){
        //debit 0-не обработан  1-оплачен 2-отказ 3-возврат
        $admin_email= Yii::$app->params['adminEmail'];
        $order = Orders::findOne($model_id);
        $ord_prods = OrderProducts::find()->where(['id_order' =>$model_id ])->asArray()->all();

        //статус оплачен
        if($status ==2 or $status ==3  and $debit == 0 and $debit !=3){
            foreach ($ord_prods as $items){
                $id = $items['id_product'];
                $res_img = ImageProducts::findOne($items['id_product']);
                $res = $res_img['reserv'] - $items['qty'];

            Yii::$app->db->createCommand("UPDATE image_products SET reserv = $res   WHERE id= $id")->execute();
            Yii::$app->db->createCommand("UPDATE orders SET debit = 1   WHERE id= $model_id")->execute();
            }
            //начисляем баллы за продажу
            if($order->card_id!= null){
                $card = Cards::find ()->where (['username'=>$order->card_id])->one ();
                $points = $card->points + (($order->sum*10)/100);
                Yii::$app->db->createCommand("UPDATE cards SET points = $points   WHERE username= $order->card_id")->execute();}

        }

        //статус возврат
        elseif ($status == 1 and $debit !=3){

            foreach ($ord_prods as $items){
                $id = $items['id_product'];
                $res_img = ImageProducts::findOne($items['id_product']);
                $ava = $res_img['avalible'] + $items['qty'];
            }
            Yii::$app->db->createCommand("UPDATE image_products SET avalible = $ava   WHERE id= $id")->execute();
            Yii::$app->db->createCommand("UPDATE orders SET debit = 3   WHERE id=  $model_id")->execute();

            //списываем баллы за возврат
            if($order->card_id!= null){
                $card = Cards::find ()->where (['username'=>$order->card_id])->one ();
                $points = $card->points - (($order->sum*10)/100);
                Yii::$app->db->createCommand("UPDATE cards SET points = $points   WHERE username= $order->card_id")->execute();}

        }
        //статус отказ
        elseif($status == 4 and $debit !=2 and $debit !=3){

            if ($order->points != null){
                $card = Cards::find()->where(['username'=>$order->card_id])->one();
                $val = $order->points + $card['points']-$order->discount;
                Yii::$app->db->createCommand("UPDATE cards SET points = $val   WHERE username = $order->card_id")->execute();
                Yii::$app->db->createCommand("UPDATE cards SET points = $val   WHERE username = $order->card_id")->execute();
            }
            Yii::$app->db->createCommand("UPDATE orders SET debit = 2   WHERE id=  $model_id")->execute();
            foreach ($ord_prods as $items){
                $id = $items['id_product'];
                $res_img = ImageProducts::findOne($items['id_product']);
                $res = $res_img['reserv'] - $items['qty'];
                $ava = $res_img['avalible'] + $items['qty'];
            }
            Yii::$app->db->createCommand("UPDATE image_products SET avalible = $ava   WHERE id= $id")->execute();
            Yii::$app->db->createCommand("UPDATE image_products SET reserv = $res   WHERE id= $id")->execute();
        }

        //сообщение клиенту
        $id_ord = 'Статус вашего заказа №'.$model_id.' в Taurus-market, был изменен на: '.$order->orderStatus->name;
        Yii::$app->mailer->compose ('order', ['session' => $ord_prods,'order'=>$order])
            ->setFrom ([$admin_email=>'Taurus-market'])
            ->setTo ($order['email'])
            ->setSubject ($id_ord)
            ->send ();
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setStatus($model->status,$model->debit,$model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
