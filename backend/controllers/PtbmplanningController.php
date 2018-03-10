<?php

namespace backend\controllers;

use common\models\PRODSPECTIREASSY;
use common\models\PTBMPlanning;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class PtbmplanningController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PTBMPlanning();

        return $this->renderAjax('create', ['model' => $model]);
    }

    public function actionGetid()
    {
        $id = Yii::$app->request->post("id");
        if (!empty($id)) {
//            return Json::encode(123456);
            
        }
    }
}
