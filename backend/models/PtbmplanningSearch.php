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

        foreach ($query as $item) {
            $cnt++;
            if ($cnt === 4) {
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
        $query = PTBMPlanning::findAll([["like", "itemid", $this->itemid], [">=", "convert(date,date)", $this->startdate], ["<=", "convert(date,date)", $this->enddate]]);
        $temp = [];
        $cnt = 0;
        foreach ($query as $item) {
            $cnt++;
            if ($cnt === 4) {
                array_push($temp, [
                    "id" => $item->itemid,
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
}