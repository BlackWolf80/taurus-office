<?php
/**
 * Created by PhpStorm.
 * User: danil
 * Date: 06.09.18
 * Time: 11:46
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\UploadForm;

class UploadController extends Controller
{
    public function actionIndex()
    {
        $model = new UploadForm();

        return $this->render('index', ['model'=>$model]);
    }
}