<?php

namespace backend\controllers;

use backend\models\PibimcstandardSearch;
use backend\models\UserDirect;
use common\models\PIBIMCStandardDetail;
use common\models\PIBIMCStandardMaster;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PibimcstandardController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
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
     * @return mixed
     */

    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $role = 1 : $role = 0;

        $searchModel = new PibimcstandardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new PIBIMCStandardDetail();

        if ($model->load(Yii::$app->request->post())) {
//            print_r($model);
            $temp = new PIBIMCStandardDetail();
            $temp->refid = $model->refid;
            $temp->amount = $model->amount;
            $temp->hour = $model->hour;
            $temp->rate = $model->rate;
            $temp->save(false);

            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }

    }

    public function actionCreatemaster()
    {
        $model = new PIBIMCStandardMaster();
        if ($model->load(Yii::$app->request->post())) {

        } else {
            return $this->render('createmaster', [
                'model' => $model
            ]);
        }
    }

    public function actionDcreate()
    {
        $model = new PIBIMCStandardDetail();
        if ($model->load(Yii::$app->request->post())) {

        } else {
            return $this->render('dcreate', [
                'model' => $model
            ]);
        }
    }

    public function actionCreatemasterlist()
    {
        $Req = Yii::$app->request;
        $Name = $Req->post("namex");
        $Ref = $Req->post("refx");

        for ($i = 0; $i < count($Name); $i++) {
            $ms = new PIBIMCStandardMaster();
            $ms->name = $Name[$i];
            $ms->refid = $Ref[$i];
            $ms->save();
        }

        return $this->redirect(['index']);
    }

    public function actionCreatedetail()
    {
        $Req = Yii::$app->request;
        $Std = $Req->post("stdx");
        $Hour = $Req->post("hourx");
        $Amount = $Req->post("amountx");
        $Rate = $Req->post("ratex");

        for ($i = 0; $i < count($Std); $i++) {
            $model = new PIBIMCStandardDetail();
            $model->refid = $Std[$i];
            $model->hour = $Hour[$i];
            $model->amount = $Amount[$i];
            $model->rate = $Rate[$i];
            $model->save();
        }

        return $this->redirect(['index']);
    }
}
