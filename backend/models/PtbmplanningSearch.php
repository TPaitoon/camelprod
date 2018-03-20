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

        for ($z = 0; $z < count($datear); $z++) {
            $base = PTBMPlanning::findOne(["itemid" => $itemar[$z], "date" => $datear[$z]]);
            array_push($temp, [
                "id" => $base->id,
                "wrno" => $base->wrno,
                "date" => $base->date,
                "itemid" => $base->itemid,
                "qty" => $base->qty,
                "status" => $base->status,
            ]);
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

        for ($z = 0; $z < count($datear); $z++) {
            $base = PTBMPlanning::findOne(["itemid" => $itemar[$z], "date" => $datear[$z]]);
            array_push($temp, [
                "id" => $base->id,
                "wrno" => $base->wrno,
                "date" => $base->date,
                "itemid" => $base->itemid,
                "qty" => $base->qty,
                "status" => $base->status,
            ]);
        }
        $dataProvider = new ArrayDataProvider(["allModels" => $temp]);
        return $dataProvider;
    }
}