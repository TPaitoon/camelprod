<?php

namespace backend\controllers;

use backend\models\PibitubecalculatorSearch;
use backend\models\UserDirect;
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

                                                            
        return $this->render('index', [
            'role' => $role,
            'searchModel' => $searchModel
        ]);
    }

}
