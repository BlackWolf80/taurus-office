<?php

namespace app\controllers;

use app\models\CardOperations;
use Yii;
use app\models\Cards;
use app\models\CardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

/**
 * CardController implements the CRUD actions for Cards model.
 */
class CardController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cards models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cards model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {


        $cardName= Cards::findOne($id);


        $operationList = new ActiveDataProvider([
            'query' => CardOperations::find()->where(['card_number'=>$cardName]),

            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC
                ]],
        ]);


        // загружаем данные по ID
        $model = $this->findModel($id);
        // если POST - значит идет сохранение с формы
        if( \Yii::$app->getRequest()->isPost ){
            // если аттрибуты загрузились и отвалидировались - можно сохранять
            if( $model->load( \Yii::$app->request->post() ) && $model->validate() ){

                if($model->attributes['points'] > 0 and $model->attributes['points']<=$model->oldAttributes['points']){

                    $credit = $model->attributes['points'];

                    $model->points= $model->oldAttributes['points']-$model->attributes['points'];
                    $model->save( false );

                    $operation = new CardOperations();
                    $operation->card_number= $model->username;
                    $operation->summ=$credit;
                    $operation->operation_type = 'Списание';
                    $operation->note = 'Оператор: '.Yii::$app->user->identity->username;
                    $operation->save(false);



                    Yii::$app->session->setFlash('success','Данные приняты');
                    return $this->refresh();
                }
                else{
                    Yii::$app->session->setFlash('error','Ошибка');
                    return $this->refresh();
                }
            }
        }

//        return $this->render('view', [
//            'model' => $model,'operationList'=>$operationList,
//        ]);
        return $this->render('view',compact('model','operationList'));
    }

    public function actionPrint(){
        $operation =CardOperations::find()->where(['id'=>$_GET['id']])->with('card')->one();
        $operation->print = 1;
        $operation->save(false);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('print', compact('operation'));

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
//            'cssFile' => 'css/print.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Бланк списания средств'],
            'marginTop' => 0 ,
            'marginLeft' => 0,
            'marginRight' => 0,
            'marginBottom' => 0,

            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>['Заголовок'],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    /**
     * Creates a new Cards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cards();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cards model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cards::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
