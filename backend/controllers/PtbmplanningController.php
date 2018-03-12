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

        return $this->renderAjax('create', ['model' => $model]);
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
            $cnt = PTBMPlanning::findAll(["itemid" => $id, "cast(date as date)" => $date]);
            return count($cnt);
        }
    }
}
