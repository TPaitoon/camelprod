<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 14/03/2018
 * Time: 9:38
 */

namespace backend\models;

use common\models\PTBMPlanning;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * PtbmplanningSearch common\models\PTBMPlanning
 */
class PtbmplanningSearch extends PTBMPlanning
{
    public $startdate, $enddate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wrno', 'itemid', 'child_itemid', 'assy_Frame', 'qty', 'status'], 'integer'],
            [['date', 'startdate', 'enddate'], 'safe'],
            [['asset', 'group', 'desc', 'child_desc'], 'string'],
            [['assy_Weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function searchcreated()
    {
        $query = PTBMPlanning::findAll(["status" => 0]);
        $temp = [];
        $cnt = 0;

        $datear = [];
        $itemar = [];

        foreach ($query as $item) {
            for ($i = 0; $i < count($query); $i++) {
                if (empty($datear) && empty($itemar)) {
                    array_push($datear, $item->date);
                    array_push($itemar, $item->itemid);
                } else {
                    if (!in_array($item->date, $datear) && !in_array($item->itemid, $itemar)) {
                        array_push($datear, $item->date);
                        array_push($itemar, $item->itemid);
                    }
                }
            }
        }

//        for ($i =0; $i < count($datear); $i++) {
//            $base = PTBMPlanning::find()->where(["itemid" => $itemar[$i], "date" =>$item->date])->count();
//        }
        foreach ($query as $item) {
            $cnt++;
            if ($cnt === $base) {
                array_push($temp, [
                    "id" => $item->id,
                    "wrno" => $item->wrno,
                    "date" => $item->date,
                    "itemid" => $item->itemid,
                    "qty" => $item->qty,
                    "status" => $item->status,
                ]);
                $cnt = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            "allModels" => $temp
        ]);
        return $dataProvider;
    }

    public function search($params)
    {
        if (empty($this->startdate) && empty($this->enddate)) {
            $this->startdate && $this->enddate = date('Y-m-d');
        }
        $this->load($params);
        $query = PTBMPlanning::find()->andFilterWhere(["and", [">=", "convert(date,date)", $this->startdate], ["<=", "convert(date,date)", $this->enddate], ["like", "itemid", $this->itemid]])->all();
        $temp = [];
        $cnt = 0;
        $base = 0;
        foreach ($query as $item) {
            $cnt++;
            if ($cnt === $base) {
                array_push($temp, [
                    "id" => $item->id,
                    "wrno" => $item->wrno,
                    "date" => $item->date,
                    "itemid" => $item->itemid,
                    "qty" => $item->qty,
                    "status" => $item->status
                ]);
                $cnt = 0;
            }
        }
        $dataProvider = new ArrayDataProvider(["allModels" => $temp]);
        return $dataProvider;
    }

    private function findArrayData($id, $type)
    {
        $obj = PTBMPlanning::findOne(["id" => $id]);
        if ($type === 1) {
            return $obj->itemid;
        } else if ($type === 2) {
            return $obj->date;
        }
    }
}