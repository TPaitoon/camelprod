<?php

namespace backend\controllers;

use backend\models\PibitubecalculatorSearch;
use backend\models\UserDirect;
use backend\models\PIBITubeDetail;
use common\models\EmpInfo;
use common\models\PIBITubeEmplist;
use common\models\PIBITubeMaster;
use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PibitubecalculatorController extends Controller
{
    public $enableCsrfValidation = false;

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

        if ($model->load(Yii::$app->request->post())) {
            $mst = new PIBITubeMaster();
            $mst->shift = $model->shift;
            $mst->date = $model->date;
            $mst->status = 0;

            if ($mst->save(false)) {
                $req = Yii::$app->request;
                $idlist = $req->post("empids");
                $namelist = $req->post("empnames");
                $grouplist = $req->post("groups");
                $valuelist = $req->post("values");

                for ($i = 0; $i < count($idlist); $i++) {
                    for ($x = 0; $x < count($grouplist); $x++) {
                        $dtl = new PIBITubeDetail();
                        $dtl->shift = $model->shift;
                        $dtl->empid = $idlist[$i];
                        $dtl->empname = $namelist[$i];
                        $dtl->date = $model->date;
                        $dtl->rate = $model->rate;
                        $dtl->itemid = $grouplist[$x];
                        $dtl->qty = $valuelist[$x];
                        $dtl->refid = $mst->id;
                        $dtl->save(false);
                    }

                    for ($z = 0; $z <= 2; $z++) {
                        $pibitd = new PIBITubeDetail();
                        $pibitd->shift = $model->shift;
                        $pibitd->empid = $idlist[$i];
                        $pibitd->empname = $namelist[$i];
                        $pibitd->date = $model->date;
                        $pibitd->rate = $model->rate;
                        if ($z == 0) {
                            $pibitd->itemid = 91;
                            $pibitd->qty = $model->losttube1;
                        } elseif ($z == 1) {
                            $pibitd->itemid = 92;
                            $pibitd->qty = $model->losttube2;
                        } elseif ($z == 2) {
                            $pibitd->itemid = 93;
                            $pibitd->qty = $model->car;
                        }
                        $pibitd->refid = $mst->id;
                        $pibitd->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $mst = $this->findModel($id);
        $query = PIBITubeDetail::find()->where(['refid' => $mst->id]);
        $model = new PIBITubeDetail();
        $data = $query->all();
        $_listid = [];
        $recid = [];
        $groupdatalist = [];

        for ($i = 0; $i < count($data); $i++) {
            array_push($recid, $data[$i]->id);
            if ($i == 0) {
                array_push($_listid, $data[$i]->empid);
            } elseif ($this->findArray($data[$i]->empid, $_listid) == true) {
                array_push($_listid, $data[$i]->empid);
            }
        }

        $clone = $query;
        $cnt = $clone->andWhere(['empid' => $_listid[0]])->count();
        $cloneall = $query;
        $datalist = $cloneall->orderBy(['itemid' => 4])->all();
        for ($z = 0; $z < $cnt; $z++) {
            $chk = (integer)$datalist[$z]->itemid;
            if ($chk !== 91 && $chk !== 92 && $chk !== 93) {
                array_push($groupdatalist, ['group' => $chk, 'value' => $datalist[$z]->qty]);
            } elseif ($chk == 91) {
                $model->losttube1 = $datalist[$z]->qty;
            } elseif ($chk == 92) {
                $model->losttube2 = $datalist[$z]->qty;
            } elseif ($chk == 93) {
                $model->car = $datalist[$z]->qty;
                $model->shift = $datalist[$z]->shift;
                $model->date = $datalist[$z]->date;
                $model->rate = $datalist[$z]->rate;
            }
        }
        $listid = null;
        sort($_listid, SORT_ASC);
        for ($lx = 0; $lx < count($_listid); $lx++) {
            if ($lx == 0) {
                $listid = $_listid[$lx];
            } else {
                $listid = $listid . "," . $_listid[$lx];
            }
        }
        $itemid = null;
        ArrayHelper::multisort($groupdatalist, ['group'], 4);
        for ($ix = 0; $ix < count($groupdatalist); $ix++) {
            if ($ix == 0) {
                $itemid = $groupdatalist[$ix]["group"] . ":" . $groupdatalist[$ix]["value"];
            } else {
                $itemid = $itemid . "," . $groupdatalist[$ix]["group"] . ":" . $groupdatalist[$ix]["value"];
            }
        }
        $model->listid = $listid;
        $model->itemid = $itemid;
        $model->recid = $recid;
        $title = $mst->id;

        if ($model->load(Yii::$app->request->post())) {
//            return print_r($model->recid);
            $_tempquery = $this->findModel($mst->id);
//            $_recid = explode(",", $model->recid);
            for ($r = 0; $r < count($model->recid); $r++) {
                PIBITubeDetail::deleteAll(['id' => $model->recid[$r]]);
            }
            $master = $this->findModel($_tempquery->id);
            $master->date = $model->date;
            $master->shift = $model->shift;
            $master->status = 0;
            if ($master->save(false)) {
                $req = Yii::$app->request;
                $idlist = $req->post("empids");
                $namelist = $req->post("empnames");
                $grouplist = $req->post("groups");
                $valuelist = $req->post("values");

                for ($i = 0; $i < count($idlist); $i++) {
                    for ($x = 0; $x < count($grouplist); $x++) {
                        $detail = new PIBITubeDetail();
                        $detail->shift = $model->shift;
                        $detail->empid = $idlist[$i];
                        $detail->empname = $namelist[$i];
                        $detail->date = $model->date;
                        $detail->rate = $model->rate;
                        $detail->itemid = $grouplist[$x];
                        $detail->qty = $valuelist[$x];
                        $detail->refid = $master->id;
                        $detail->save(false);
                    }
                    for ($z = 0; $z <= 2; $z++) {
                        $value = new PIBITubeDetail();
                        $value->shift = $model->shift;
                        $value->empid = $idlist[$i];
                        $value->empname = $namelist[$i];
                        $value->date = $model->date;
                        $value->rate = $model->rate;
                        if ($z == 0) {
                            $value->itemid = 91;
                            $value->qty = $model->losttube1;
                        } elseif ($z == 1) {
                            $value->itemid = 92;
                            $value->qty = $model->losttube2;
                        } elseif ($z == 2) {
                            $value->itemid = 93;
                            $value->qty = $model->car;
                        }
                        $value->refid = $master->id;
                        $value->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', ['model' => $model, 'title' => $title]);
        }
    }

    public function actionView($id)
    {
        $mst = $this->findModel($id);
        $query = PIBITubeDetail::find()->where(['refid' => $mst->id]);
        $model = new PIBITubeDetail();
        $data = $query->all();
        $_listid = [];
        $recid = [];
        $groupdatalist = [];

        for ($i = 0; $i < count($data); $i++) {
            array_push($recid, $data[$i]->id);
            if ($i == 0) {
                array_push($_listid, $data[$i]->empid . ' ' . $data[$i]->empname);
            } elseif ($this->findArray($data[$i]->empid . ' ' . $data[$i]->empname, $_listid) == true) {
                array_push($_listid, $data[$i]->empid . ' ' . $data[$i]->empname);
            }
        }

        $empidz = [];
        for ($z = 0; $z < count($_listid); $z++) {
            $tempz = explode(" ", $_listid[$z]);
            array_push($empidz, $tempz[0]);
        }

        $clone = $query;
        $cnt = $clone->andWhere(['empid' => $empidz[0]])->count();
        $cloneall = $query;
        $datalist = $cloneall->orderBy(['itemid' => 4])->all();
        for ($z = 0; $z < $cnt; $z++) {
            $chk = (integer)$datalist[$z]->itemid;
            if ($chk !== 91 && $chk !== 92 && $chk !== 93) {
                array_push($groupdatalist, ['group' => $chk, 'value' => $datalist[$z]->qty]);
            } elseif ($chk == 91) {
                $model->losttube1 = $datalist[$z]->qty;
            } elseif ($chk == 92) {
                $model->losttube2 = $datalist[$z]->qty;
            } elseif ($chk == 93) {
                $model->car = $datalist[$z]->qty;
                $model->shift = $datalist[$z]->shift;
                $model->date = $datalist[$z]->date;
                $model->rate = $datalist[$z]->rate;
            }
        }
        $listid = null;
        sort($_listid, SORT_ASC);
        for ($lx = 0; $lx < count($_listid); $lx++) {
            if ($lx == 0) {
                $listid = $_listid[$lx];
            } else {
                $listid = $listid . "," . $_listid[$lx];
            }
        }
        $itemid = null;
        ArrayHelper::multisort($groupdatalist, ['group'], 4);
        for ($ix = 0; $ix < count($groupdatalist); $ix++) {
            if ($ix == 0) {
                $itemid = $groupdatalist[$ix]["value"];
            } else {
                $itemid = $itemid + $groupdatalist[$ix]["value"];
            }
        }
        $model->listid = $listid;
        $model->itemid = $itemid;
        $model->recid = $recid;
        $model->refid = $mst->id;

        return $this->renderAjax("view", ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $master = $this->findModel($id);
        if (!empty($master)) {
            PIBITubeDetail::deleteAll(['refid' => $master->id]);
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

            return $this->redirect(['index']);
        }
    }

    private function findArray($valueofcheck, $valueofarray)
    {
        for ($i = 0; $i < count($valueofarray); $i++) {
            if ($valueofcheck == $valueofarray[$i]) {
                return false;
            }
        }
        return true;
    }

    private function findModel($id)
    {
        if (($model = PIBITubeMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetempname()
    {
        $req = Yii::$app->request;
        if ($req->isAjax) {
//            $temp = $req->post("empid");
            $id = $req->post("id");
            if (!empty($id)) {
                $_empid = PIBITubeEmplist::find()
                    ->where(['shift' => $id])
                    ->all();

                $empid = [];
                foreach ($_empid as $item) {
                    array_push($empid, $item->empid);
                }

                $temparray = [];
                for ($i = 0; $i < count($_empid); $i++) {
                    $_query = EmpInfo::find()
                        ->where(['PRS_NO' => $empid[$i]])
                        ->one();
                    $name = $empid[$i] . ' ' . $_query->EMP_NAME . ' ' . $_query->EMP_SURNME;
                    array_push($temparray, $name);
                }

                return Json::encode($temparray);
            } else {
                $eid = $req->post("empid");
                if (!empty($eid)) {
                    $listemp = explode(",", $eid);
                    $temparray = [];

                    for ($i = 0; $i < count($listemp); $i++) {
                        $query = EmpInfo::find()->select(['EMP_NAME', 'EMP_SURNME'])
                            ->where(['PRS_NO' => $listemp[$i]])->one();

                        if (!empty($query)) {
                            $name = $listemp[$i] . ' ' . $query->EMP_NAME . ' ' . $query->EMP_SURNME;
                            array_push($temparray, $name);
                        }
                    }

                    return Json::encode($temparray);
                }
            }
        }
    }

    public function actionGetamount()
    {
        $req = Yii::$app->request;
        if ($req->isAjax) {
            $temp = $req->post("amount");
            if (!empty($temp)) {
                $_list = explode(",", $temp);
                $_templist = [];
                for ($_i = 0; $_i < count($_list); $_i++) {
                    /* return $_templist :: XX:XXXX */
                    array_push($_templist, $_list[$_i]);
                }
                return Json::encode($_templist);
            }
        }
    }

    public function actionGetcount()
    {
        $req = Yii::$app->request;
        if ($req->isAjax) {
            $shift = $req->post("shift");
            $date = $req->post("date");

            $cnt = PIBITubeMaster::find()->where(['shift' => $shift, 'date' => $date])->count();

            if ($cnt > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function actionSetapproved()
    {
        $ar = Yii::$app->request->post("data");
        $ls = [];

        if (!empty($ar)) {
            for ($i = 0; $i < count($ar); $i++) {
                if (strlen($ar[$i] === 1)) {
                    continue;
                } else {
                    $temp = explode(":", $ar[$i]);
                    array_push($ls, $temp[0]);
                }
            }

            for ($x = 0; $x < count($ls); $x++) {
                try {
                    PIBITubeMaster::updateAll(["status" => 1], ["id" => $ls[$x]]);
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
                    PIBITubeMaster::updateAll(["status" => 1], ["id" => $id]);
                } catch (Exception $exception) {
                    return 0;
                }
                return 1;
            } else {
                return 0;
            }
        }
    }
}
