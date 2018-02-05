<?php

namespace backend\controllers;

use backend\models\PibitubecalculatorSearch;
use backend\models\UserDirect;
use backend\models\PIBITubeDetail;
use Yii;
use yii\web\Controller;

class PibitubecalculatorController extends Controller
{
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;

        $req = Yii::$app->request;
        $searchModel = new PibitubecalculatorSearch();

        if ($req->isGet && isset($req->queryParams['PibitubecalculatorSearch']['startdate'])) {
            $dataProvider = $searchModel->search($req->queryParams);
        } else {
            $dataProvider = $searchModel->searchcreated();
        }

        return $this->render('index', [
            'role' => $role,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new PIBITubeDetail();

        return $this->render('create', ['model' => $model]);
    }

}
