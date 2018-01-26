<?php

namespace backend\controllers;

use backend\models\PibimccalculatorSearch;
use backend\models\UserDirect;
use common\models\PIBIMCDetail;
use Yii;
use yii\web\Controller;

class PibimccalculatorController extends Controller
{
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;

        $app = Yii::$app->request;
        $searchModel = new PibimccalculatorSearch();

        if ($app->isGet && isset($app->queryParams['Pibimccalculator']['startdate'])) {
            $dataProvider = $searchModel->search($app->queryParams);
        } else {
            $dataProvider = $searchModel->searchcreated();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    public function actionCreate()
    {
        $model = new PIBIMCDetail();
        $app = Yii::$app->request;

        if ($model->load($app->post())) {

        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

}
