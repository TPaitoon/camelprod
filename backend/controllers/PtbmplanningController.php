<?php

namespace backend\controllers;

use backend\models\PtbmplanningSearch;
use backend\models\UserDirect;
use common\models\BOM1;
use common\models\ItemData;
use common\models\PRODSPECTIREASSY;
use common\models\PTBMPlanning;
use Exception;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PtbmplanningController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $chk = new UserDirect();
        $chk->ChkusrForPTBMOnly();

        $req = Yii::$app->request;
        $searchModel = new PtbmplanningSearch();
        if ($req->isGet && isset($req->queryParams["PtbmplanningSearch"]["startdate"])) {
            $dataProvider = $searchModel->search($req->queryParams);
        } else {
            $dataProvider = $searchModel->searchcreated();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionCreate()
    {
        $model = new PTBMPlanning();

        if ($model->load(Yii::$app->request->post())) {
            $cr = new PTBMPlanning();
            $cr->wrno = $model->wrno;
            $cr->date = $model->date;
            $cr->asset = $model->asset;
            $cr->group = $model->group;
            $cr->itemid = $model->itemid;
            $cr->qty = $model->qty;
            $cr->status = 0;
            $cr->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', ['model' => $model, 'statusinfo' => 0]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $up = PTBMPlanning::findOne(["id" => $id]);
            $up->wrno = $model->wrno;
            $up->date = $model->date;
            $up->asset = $model->asset;
            $up->group = $model->group;
            $up->itemid = $model->itemid;
            $up->qty = $model->qty;
            $up->status = 0;
            $up->save(false);
            return $this->redirect(["index"]);
//            print_r($model);
        } else {
            return $this->renderAjax("update", ["model" => $model, "statusinfo" => 1]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash("res", "ลบข้อมูลเรียบร้อยแล้ว");
        return $this->redirect(["index"]);
    }

    private function findModel($id)
    {
        if (($model = PTBMPlanning::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("The requested page does not exist.");
        }
    }

    public function actionGetcid()
    {
        $id = Yii::$app->request->post("id");
        if (!empty($id)) {
//            return Json::encode($id);   /* return $id */
            $query = BOM1::findAll(["Parent_ItemID" => $id]);
            $ArrayQuery = [];
            foreach ($query as $item) {
                $desc = ItemData::findOne(["ITEMID" => $item->Child_ItemID]);
                array_push($ArrayQuery, $item->Child_ItemID . ":" . $desc->DESCRIPTION);
            }
            return Json::encode($ArrayQuery);
        }
    }

    public function actionGetdesc()
    {
        $id = Yii::$app->request->post("id");
        if (!empty($id)) {
            $query = ItemData::findOne(["ITEMID" => $id]);
            $obj = PRODSPECTIREASSY::findOne(["Assy_ID" => $id]);
            return Json::encode($query->DESCRIPTION . ":" . $obj->Assy_Frame . ":" . $obj->Assy_Weight);
        }
    }

    public function actionGetcount()
    {
        $req = Yii::$app->request;
        $id = $req->post("id");
        $date = $req->post("date");
        if (!empty($id) && !empty($date)) {
            $query = PTBMPlanning::findAll(["itemid" => $id, "convert(date,date)" => date('Y-m-d', strtotime($date))]);
            return count($query);
        }
    }

    public function actionSetapproved()
    {
        $getData = Yii::$app->request->post("data");
        $ls = [];
        if (!empty($getData)) {
            for ($i = 0; $i < count($getData); $i++) {
                if (strlen($getData[$i]) == 1) {
                    continue;
                } else {
                    $temp = explode(":", $getData[$i]);
                    array_push($ls, $temp[0]);
                }
            }
            for ($x = 0; $x < count($ls); $x++) {
                try {
                    $obj = PTBMPlanning::findOne(["id" => $ls[$x]]);
                    PTBMPlanning::updateAll(["status" => 2], ["itemid" => $obj->itemid, "date" => $obj->date]);
                } catch (Exception $exception) {
                    return 0;
                }
            }
            return 1;
        } else {
            return 0;
        }
    }
}
