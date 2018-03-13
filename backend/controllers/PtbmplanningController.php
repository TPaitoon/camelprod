<?php

namespace backend\controllers;

use common\models\BOM1;
use common\models\ItemData;
use common\models\PRODSPECTIREASSY;
use common\models\PTBMPlanning;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class PtbmplanningController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PTBMPlanning();

        if ($model->load(Yii::$app->request->post())) {
//            print_r($model);
//            print_r(Yii::$app->request->post("itemid"));
//            print_r(Yii::$app->request->post("desc"));
            $c_itemid = Yii::$app->request->post("itemid");
            $c_desc = Yii::$app->request->post("desc");
            for ($i = 0; $i < count($c_itemid); $i++) {
                $cr = new PTBMPlanning();
                $cr->wrno = $model->wrno;
                $cr->date = $model->date;
                $cr->asset = $model->asset;
                $cr->group = $model->group;
                $cr->itemid = $model->itemid;
                $cr->child_itemid = $c_itemid[$i];
                $cr->child_desc = $c_desc[$i];
                $cr->desc = $model->desc;
                $cr->assy_Frame = $model->assy_Frame;
                $cr->assy_Weight = $model->assy_Weight;
                $cr->qty = $model->qty;
                $cr->status = 0;
                $cr->save(false);
            }
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', ['model' => $model, 'statusinfo' => 0]);
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
            $query = PTBMPlanning::findAll(["itemid" => $id, "convert(date,date)" => date('Y-m-d',strtotime($date))]);
            return count($query);
        }
    }
}
