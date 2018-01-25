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
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;

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
//            print_r($model);
            $temp = new PIBIMCStandardMaster();
            $temp->name = $model->name;
            $temp->refid = $model->refid;
            $temp->save(false);

            return $this->redirect(['createmaster']);
        } else {
            return $this->render('createmaster', [
                'model' => $model
            ]);
        }

    }

}
