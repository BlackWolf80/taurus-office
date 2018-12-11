<?php
/**
 * Created by PhpStorm.
 * User: danil
 * Date: 30.10.17
 * Time: 13:14
 */

namespace app\controllers;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AppController extends Controller{


    public function debug($arr)
    {
        echo '<pre>'. print_r($arr, true).'</pre>';
    }

    protected function setMeta($title = null, $keywords = null, $description = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

    public function behaviors()
    {
        $section = ['logout','about','contact','index'];
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
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }


}

function debug($arr){echo '<pre>'. print_r($arr, true).'</pre>';}