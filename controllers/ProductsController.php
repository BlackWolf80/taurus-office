<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\UploadForm;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AppController
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
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }


    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->with(['category','comments','property']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',"Товар {$model->name} добавлен");
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**iiii
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $session = Yii::$app->session;
        $session->open();
        $model->dir=$session['dir'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpload($id){

        /* Функция для удаления лишних файлов: сюда, помимо удаления текущей и
        родительской директории, так же можно добавить файлы,
        не являющиеся картинкой (проверяя расширение) */
        function excess($files) {
            $result = array();
            for ($i = 0; $i < count($files); $i++) {
                if ($files[$i] != "." && $files[$i] != "..") $result[] = $files[$i];
            }
            return $result;
        }

        $group=Products::find()->where(['id'=>$id])->with('category')->one();
        $dir= Yii::getAlias('@webroot').'/images/upload/'.$group->category->id.'/'.$id; // Путь к директории, в которой лежат изображения
        $dirShow='/images/upload/'.$group->category->id.'/'.$_GET['id']; //короткий путь к директории с изображениями

        $session = Yii::$app->session;
        $session->open();
        $session['dir']=$dirShow;

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $files = scandir($dir); // Получаем список файлов из этой директории
        $files = excess($files); // Удаляем лишние файлы

        //удаление файла
        if(isset($_GET['del'])){
            $filename = $dir.'/'.$_GET['del'];
            @unlink($filename);
            return $this->redirect('upload?id='.$id);
        }

        //загрузка файла
        $model = new UploadForm();
        if(Yii::$app->request->post())
        {



            $model->file = UploadedFile::getInstance($model, 'file');
            $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20);

            if ($model->validate()) {
                $path = $dir .'/'.$filename.'.';
                $model->file->saveAs($path.$model->file->extension);
                return $this->refresh();
            }
        }

        return $this->render('upload',compact('model','files','dirShow'));
    }




    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
