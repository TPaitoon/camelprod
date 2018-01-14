<?php

namespace backend\controllers;

use backend\models\PIBIDetail;
use yii\filters\VerbFilter;

class PibicalculatorController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PIBIDetail();

        return $this->render('create', ['model' => $model]);
    }
}
