<?php

namespace backend\controllers;

use backend\models\PibimccalculatorSearch;
use backend\models\UserDirect;
use backend\models\PIBIMCDetail;
use common\models\EmpInfo;
use common\models\PIBIMCEmplist;
use common\models\PIBIMCMaster;
use common\models\PIBIMCStandardDetail;
use Yii;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PibimccalculatorController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;

        $app = Yii::$app->request;
        $searchModel = new PibimccalculatorSearch();

        if ($app->isGet && isset($app->queryParams['PibimccalculatorSearch']['startdate'])) {
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
            $_master = new PIBIMCMaster();
            $_master->date = $model->date;
            $_master->group = $model->groupid;
            $_master->shift = $model->shiftid;
            $_master->status = 0;
            if ($_master->save(false)) {
                $emplist = $app->post('empids');
                $empnamelist = $app->post('empnames');
                for ($i = 0; $i < count($emplist); $i++) {
                    for ($r = 1; $r <= 4; $r++) {
                        $_detail = new PIBIMCDetail();
                        $_detail->groupid = $model->groupid;
                        $_detail->shiftid = $model->shiftid;
                        $_detail->empid = $emplist[$i];
                        $_detail->empname = $empnamelist[$i];
                        $_detail->date = $model->date;
                        $_detail->hour = $model->hour;
                        $_detail->typeid = $r;
                        if ($r == 1) {
                            $_detail->qty = $model->amount;
                        } elseif ($r == 2) {
                            $_detail->qty = $model->losttire1;
                        } elseif ($r == 3) {
                            $_detail->qty = $model->losttire2;
                        } elseif ($r == 4) {
                            $_detail->qty = $model->losttube;
                        }
                        $_detail->deduct = $model->deduct;
                        $_detail->itemid = $model->itemid;
                        $_detail->refid = $_master->id;
                        $_detail->rate = $model->rate;
                        $_detail->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionView($id)
    {
        $master = $this->findModel($id);
        $query = PIBIMCDetail::find()->where(['refid' => $master->id])
            ->andWhere(['shiftid' => $master->shift, 'groupid' => $master->group])
            ->andFilterWhere(['date' => date('Y-m-d', strtotime($master->date))])
            ->all();
        $model = new PIBIMCDetail();
        $c = 0;
        $recid = null;

        foreach ($query as $item) {
            $recid == '' ? $recid = $recid . $item->id : $recid = $recid . ',' . $item->id;
            $item->typeid == 1 ? $model->amount = $item->qty : $model->amount;
            $item->typeid == 2 ? $model->losttire1 = $item->qty : $model->losttire1;
            $item->typeid == 3 ? $model->losttire2 = $item->qty : $model->losttire2;
            $item->typeid == 4 ? $model->losttube = $item->qty : $model->losttube;

            if ($item->typeid == 4) {
                $c++;
                $c == 1 ? $model->listid = $item->empid . ' ' . $item->empname : $model->listid = $model->listid . ',' . $item->empid . ' ' . $item->empname;
                $model->shiftid = $item->shiftid;
                $model->groupid = $item->groupid;
                $model->date = $item->date;
                $model->hour = $item->hour;
                $model->itemid = $item->itemid;
                $model->refid = $item->refid;
                $model->rate = $item->rate;
            }
        }
        $model->recid = $master->id . ',' . $recid;

        return $this->renderAjax('view', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $master = $this->findModel($id);
        $query = PIBIMCDetail::find()->where(['refid' => $master->id])
            ->andWhere(['shiftid' => $master->shift, 'groupid' => $master->group])
            ->all();
        $model = new PIBIMCDetail();
        $c = 0;
        $recid = null;

        foreach ($query as $item) {
            $recid == '' ? $recid = $recid . $item->id : $recid = $recid . ',' . $item->id;
            $item->typeid == 1 ? $model->amount = $item->qty : $model->amount;
            $item->typeid == 2 ? $model->losttire1 = $item->qty : $model->losttire1;
            $item->typeid == 3 ? $model->losttire2 = $item->qty : $model->losttire2;
            $item->typeid == 4 ? $model->losttube = $item->qty : $model->losttube;

            if ($item->typeid == 4) {
                $c++;
                $c == 1 ? $model->listid = $item->empid : $model->listid = $model->listid . ',' . $item->empid;
                $model->shiftid = $item->shiftid;
                $model->groupid = $item->groupid;
                $model->date = $item->date;
                $model->hour = $item->hour;
                $model->itemid = $item->itemid;
                $model->refid = $item->refid;
                $model->rate = $item->rate;
            }
        }
        $model->recid = $master->id . ',' . $recid;

        if ($model->load(Yii::$app->request->post())) {
            $_rectemp = explode(',', $model->recid);
            for ($del = 0; $del < count($_rectemp); $del++) {
                if ($del != 0) {
                    PIBIMCDetail::deleteAll(['id' => $_rectemp[$del]]);
                }
            }
            $_master = $this->findModel($_rectemp[0]);
            $_master->date = $model->date;
            $_master->group = $model->groupid;
            $_master->shift = $model->shiftid;
            $_master->status = 0;
            if ($_master->save(false)) {
                $app = Yii::$app->request;
                $emplist = $app->post('empids');
                $empnamelist = $app->post('empnames');
                for ($i = 0; $i < count($emplist); $i++) {
                    for ($r = 1; $r <= 4; $r++) {
                        $_detail = new PIBIMCDetail();
                        $_detail->groupid = $model->groupid;
                        $_detail->shiftid = $model->shiftid;
                        $_detail->empid = $emplist[$i];
                        $_detail->empname = $empnamelist[$i];
                        $_detail->date = $model->date;
                        $_detail->hour = $model->hour;
                        $_detail->typeid = $r;
                        if ($r == 1) {
                            $_detail->qty = $model->amount;
                        } elseif ($r == 2) {
                            $_detail->qty = $model->losttire1;
                        } elseif ($r == 3) {
                            $_detail->qty = $model->losttire2;
                        } elseif ($r == 4) {
                            $_detail->qty = $model->losttube;
                        }
                        $_detail->deduct = $model->deduct;
                        $_detail->itemid = $model->itemid;
                        $_detail->refid = $_master->id;
                        $_detail->rate = $model->rate;
                        $_detail->save(false);
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
            PIBIMCDetail::deleteAll(['shiftid' => $master->shift, 'groupid' => $master->group, 'date' => date('Y-m-d', strtotime($master->date))]);
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

            return $this->redirect(['index']);
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
                $FindQuery = PIBIMCStandardDetail::find();
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

    private function calculator($amount, $hour, $std)
    {
        $FindQuery = PIBIMCStandardDetail::find();
        $_data = $FindQuery->andWhere(['hour' => $hour, 'refid' => $std])
            ->andFilterWhere(['<=', 'amount', $amount])
            ->one();
        if (!empty($_data)) {
            $ex = ((int)$amount - $_data->amount) * 0.2917;
            $cal = $_data->rate + $ex;
            return Json::encode(round($cal));
        } else {
            $_data = $FindQuery->andFilterWhere(['hour' => $hour - 1, 'refid' => $std])
                ->andFilterWhere(['<=', 'amount', $amount])
                ->one();
            if (!empty($_data)) {
                return Json::encode($_data->rate);
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
                    $temp = explode(':', $ar[$i]);
                    array_push($ls, $temp[0]);
                }
            }

            for ($x = 0; $x < count($ls); $x++) {
                try {
                    PIBIMCMaster::updateAll(['status' => 1], ['id' => $ls[$x]]);
                } catch (Exception $exception) {
                    return 0;
                }
            }
            return 1;
        } else {
            $req = Yii::$app->request;
            $id = $req->post("id");
            if (!empty($id)) {
                try {
                    PIBIMCMaster::updateAll(["status" => 1], ["id" => $id]);
                } catch (Exception $exception) {
                    return 0;
                }
                return 1;
            } else {
                return 0;
            }
        }
    }

    private function findModel($id)
    {
        if (($model = PIBIMCMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetempname()
    {
        $app = Yii::$app->request;
        if ($app->isAjax) {
            $temp = $app->post('empid');
            if (!empty($temp)) {
                $listtemp = explode(',', $temp);
                $temparray = [];

                for ($i = 0; $i < count($listtemp); $i++) {
                    $query = EmpInfo::find()->select(['EMP_NAME', 'EMP_SURNME'])
                        ->where(['PRS_NO' => $listtemp[$i]])->one();

                    if (!empty($query)) {
                        $name = $listtemp[$i] . ' ' . $query->EMP_NAME . ' ' . $query->EMP_SURNME;
                        array_push($temparray, $name);
                    }
                }

                return Json::encode($temparray);
            } else {
                $req = Yii::$app->request;
                $sh = $req->post("shift");
                $gr = $req->post("group");

                if (!empty($sh) && !empty($gr)) {
                    $_empid = PIBIMCEmplist::findAll(["shift" => $sh, "group" => $gr]);
                    if (!empty($_empid)) {
                        $empid = [];
                        foreach ($_empid as $item) {
                            array_push($empid, $item->empid);
                        }

                        $temparray = [];
                        for ($i = 0; $i < count($_empid); $i++) {
                            $_query = EmpInfo::findOne(["PRS_NO" => $empid[$i]]);
                            $name = $empid[$i] . ' ' . $_query->EMP_NAME . ' ' . $_query->EMP_SURNME;
                            array_push($temparray, $name);
                        }

                        return Json::encode($temparray);
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            }
        }
    }

    public function actionGetcount()
    {
        $req = Yii::$app->request;
        $shift = $req->post('shift');
        $group = $req->post('group');
        $date = $req->post('date');

        $cnt = PIBIMCMaster::find()->where(['shift' => $shift, 'group' => $group, 'date' => date('Y-m-d', strtotime($date))])->count();
        return $cnt;
    }
}
