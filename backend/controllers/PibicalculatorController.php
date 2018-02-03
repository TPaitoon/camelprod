<?php

namespace backend\controllers;

use backend\models\PIBICalculator;
use backend\models\PibicalculatorSearch;
use backend\models\PIBIDetail;
use backend\models\UserDirect;
use common\models\EmpInfo;
use common\models\PIBIMaster;
use common\models\PIBIStandardDetail;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

        $app = Yii::$app->request;
        $searchModel = new PibicalculatorSearch();
        if ($app->isGet && isset($app->queryParams['PibicalculatorSearch']['startdate'])) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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

    public function actionView($id)
    {
        $master = $this->findModel($id);
        $_query = PIBIDetail::find()->where(['Refid' => $master->id])
            ->andWhere(['Shiftid' => $master->shift, 'Groupid' => $master->group])
            ->andFilterWhere(['Date' => date('Y-m-d', strtotime($master->date))])
            ->all();
        $model = new PIBIDetail();
        $c = 0;
        $recid = null;

        foreach ($_query as $i) {
            $recid == '' ? $recid = $recid . $i->id : $recid = $recid . ',' . $i->id;
            $i->Typeid == 1 ? $model->amount = $i->TQty : $model->amount;
            $i->Typeid == 2 ? $model->losttire1 = $i->TQty : $model->losttire1;
            $i->Typeid == 3 ? $model->losttire2 = $i->TQty : $model->losttire2;
            $i->Typeid == 4 ? $model->losttube = $i->TQty : $model->losttube;

            if ($i->Typeid == 4) {
                $c++;
                $c == 1 ? $model->listid = $i->Empid . '   ' . $i->Empname : $model->listid = $model->listid . ',' . $i->Empid . '   ' . $i->Empname;
                $model->Shiftid = $i->Shiftid;
                $model->Groupid = $i->Groupid;
                $model->Date = $i->Date;
                $model->Hour = $i->Hour;
                $model->Itemid = $i->Itemid;
                $model->Refid = $i->Refid;
                $model->Rate = $i->Rate;
            }
        }
        $model->recid = $master->id . ',' . $recid;

        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $master = $this->findModel($id);
        $_query = PIBIDetail::find()->where(['Refid' => $master->id])
            ->andWhere(['Shiftid' => $master->shift, 'Groupid' => $master->group])
            ->andFilterWhere(['Date' => date('Y-m-d', strtotime($master->date))])
            ->all();
        $model = new PIBIDetail();
        $c = 0;
        $recid = null;

        foreach ($_query as $i) {
            $recid == '' ? $recid = $recid . $i->id : $recid = $recid . ',' . $i->id;
            $i->Typeid == 1 ? $model->amount = $i->TQty : $model->amount;
            $i->Typeid == 2 ? $model->losttire1 = $i->TQty : $model->losttire1;
            $i->Typeid == 3 ? $model->losttire2 = $i->TQty : $model->losttire2;
            $i->Typeid == 4 ? $model->losttube = $i->TQty : $model->losttube;

            if ($i->Typeid == 4) {
                $c++;
                $c == 1 ? $model->listid = $i->Empid : $model->listid = $model->listid . ',' . $i->Empid;
                $model->Shiftid = $i->Shiftid;
                $model->Groupid = $i->Groupid;
                $model->Date = $i->Date;
                $model->Hour = $i->Hour;
                $model->Itemid = $i->Itemid;
                $model->Refid = $i->Refid;
                $model->Rate = $i->Rate;
            }
        }
        $model->recid = $master->id . ',' . $recid;

        if ($model->load(Yii::$app->request->post())) {
            $_recid = explode(",", $model->recid);
            for ($del = 0; $del < count($_recid); $del++) {
                if ($del != 0) {
                    PIBIDetail::deleteAll(['id' => $_recid[$del]]);
                }
            }

            $_master = $this->findModel($_recid[0]);
            $_master->date = $model->Date;
            $_master->group = $model->Groupid;
            $_master->shift = $model->Shiftid;
            $_master->status = 0;
            if ($_master->save(false)) {
                $app = Yii::$app->request;
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
            return $this->actionIndex();
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
        $master = $this->findModel($id);
        if (!empty($master)) {
            PIBIDetail::deleteAll(['Shiftid' => $master->shift, 'Groupid' => $master->group, 'Date' => date('Y-m-d', strtotime($master->date))]);
            $this->findModel($id)->delete();
        }
        $session = Yii::$app->session;
        $session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = PIBICalculator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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

    public function actionSetapproved()
    {
        $ar = Yii::$app->request->post('data');
        $ls = [];

        if (!empty($ar)) {
            for ($i = 0; $i < count($ar); $i++) {
                if (strlen($ar[$i]) == 1) {
                    continue;
                } else {
                    $_temp = explode(':', $ar[$i]);
                    array_push($ls, $_temp[0]);
                }
            }

            for ($x = 0; $x < count($ls); $x++) {
                try {
                    PIBICalculator::updateAll(['status' => 1], ['id' => $ls[$x]]);
                } catch (Exception $exception) {
                    return 0;
                    break;
                }
            }

            return 1;
        } else {
            return 0;
        }
    }

    public function actionGetempname()
    {
        $app = Yii::$app->request;
        if ($app->isAjax) {
            $_empid = $app->post('empid');
            if (!empty($_empid)) {
                $_list = explode(",", $_empid);
                $_temp = [];

                for ($i = 0; $i < count($_list); $i++) {
                    $_query = EmpInfo::find()->select(['EMP_NAME', 'EMP_SURNME'])
                        ->where(['PRS_NO' => $_list[$i]])
                        ->one();
                    if (!empty($_query)) {
                        $name = $_list[$i] . ' ' . $_query->EMP_NAME . ' ' . $_query->EMP_SURNME;
                        array_push($_temp, $name);
                    }
                }

                return Json::encode($_temp);
            }
        }
    }

    public function actionGetcount()
    {
        $req = Yii::$app->request;
        $shift = $req->post('shift');
        $group = $req->post('group');
        $date = $req->post('date');

        $cnt = PIBIMaster::find()->where(['shift' => $shift, 'group' => $group, 'date' => $date])->count();
        if (!empty($cnt)) {
            return $cnt;
        } else {
            return 0;
        }
    }
}
