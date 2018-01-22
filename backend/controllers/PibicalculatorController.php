<?php

namespace backend\controllers;

use backend\models\PibicalculatorSearch;
use backend\models\PIBIDetail;
use backend\models\UserDirect;
use common\models\PIBIMaster;
use common\models\PIBIStandardDetail;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;

class PibicalculatorController extends Controller
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
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();

        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;
        $searchModel = new PibicalculatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    public function actionCreate()
    {
        $model = new PIBIDetail();

        $app = Yii::$app->request;
        if ($model->load($app->post())) {
            $master = new PIBIMaster();
            $master->date = $model->Date;
            $master->group = $model->Groupid;
            $master->shift = $model->Shiftid;
            $master->status = 0;
            if ($master->save(false)) {
                $emplist = $app->post('empids');
                $empnamelist = $app->post('empnames');
                for ($i = 0; $i < count($emplist); $i++) {
                    for ($r = 1; $r <= 4; $r++) {
                        $pibidetail = new PIBIDetail();
                        $pibidetail->Groupid = $model->Groupid;
                        $pibidetail->Shiftid = $model->Shiftid;
                        $pibidetail->Empid = $emplist[$i];
                        $pibidetail->Empname = $empnamelist[$i];
                        $pibidetail->Date = $model->Date;
                        $pibidetail->Hour = $model->Hour;
                        $pibidetail->Typeid = $r;
                        if ($r === 1) {
                            $pibidetail->TQty = $model->amount;
                        } elseif ($r === 2) {
                            $pibidetail->TQty = $model->losttire1;
                        } elseif ($r === 3) {
                            $pibidetail->TQty = $model->losttire2;
                        } elseif ($r === 4) {
                            $pibidetail->TQty = $model->losttube;
                        }
                        $pibidetail->Deductid = 1;
                        $pibidetail->DQty = $model->deduct;
                        $pibidetail->Itemid = $model->Itemid;
                        $pibidetail->Refid = $master->id;
                        $pibidetail->Rate = $model->Rate;
                        $pibidetail->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionGetrate()
    {
        $app = Yii::$app->request;
        if ($app->isAjax) {
            $hour = $app->post('hour');
            $amount = $app->post('amount');
            $std = $app->post('std');

            if ($hour === '12') {
                return $this->calculator($amount, $hour, $std);
            } elseif ($hour === '11') {
                return $this->calculator($amount, $hour, $std);
            } elseif ($hour === '10') {
                return $this->calculator($amount, $hour, $std);
            } elseif ($hour === '9') {
                return $this->calculator($amount, $hour, $std);
            } elseif ($hour === '8') {
                $FindQuery = PIBIStandardDetail::find();
                $data = $FindQuery->andWhere(['hour' => $hour, 'refid' => $std])
                    ->andFilterWhere(['<=', 'amount', $amount])
                    ->one();
                if (!empty($data)) {
                    $ex = ((int)$amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    return Json::encode(0);
                }
            }
        }
    }

    public function calculator($amount, $hour, $std)
    {
        $FindQuery = PIBIStandardDetail::find();
        $data = $FindQuery->andWhere(['hour' => $hour, 'refid' => $std])
            ->andFilterWhere(['<=', 'amount', $amount])
            ->one();
        if (!empty($data)) {
            $ex = ((int)$amount - $data->amount) * 0.2917;
            $cal = $data->rate + $ex;
            return Json::encode(round($cal));
        } else {
            $data = $FindQuery->andWhere(['hour' => $hour - 1, 'refid' => $std])
                ->andFilterWhere(['<=', 'amount', $amount])
                ->one();
            if (!empty($data)) {
                return Json::encode($data->rate);
            } else {
                return Json::encode(0);
            }
        }
    }

//    public function action
}
