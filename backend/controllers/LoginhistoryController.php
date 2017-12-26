<?php

namespace backend\controllers;

use common\models\LoginHistory;
use yii\data\ActiveDataProvider;

class LoginhistoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = LoginHistory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
