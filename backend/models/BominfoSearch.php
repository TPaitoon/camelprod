<?php

namespace backend\models;

use common\models\CheckStatusInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BOMInfo;
use yii\data\ArrayDataProvider;

/**
 * BominfoSearch represents the model behind the search form about `backend\models\BOMInfo`.
 */
class BominfoSearch extends BOMInfo
{
    public $startdate, $enddate, $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeID', 'stoveid', 'checkconfirm', 'deduct', 'totaltire'], 'integer'],
            [['empid', 'empName', 'date', 'standard', 'hour'], 'safe'],
            [['qty'], 'number'],
            [['startdate', 'enddate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if ($this->startdate == '' && $this->enddate == '') {
            $this->startdate = date('d/m/Y');
            $this->enddate = date('d/m/Y');
        }
        $this->load($params);
        $query = BOMInfo::find()->andFilterWhere([
            'and',
            ['like', 'empid', $this->empid],
            ['>=', 'date', date('Y-m-d', strtotime($this->ConvertDate($this->startdate)))],
            ['<=', 'date', date('Y-m-d', strtotime($this->ConvertDate($this->enddate)))]
        ])->orderBy(['date' => SORT_ASC, 'stoveid' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $item) {
            if ($item->typeID == 1) {
                $this->losttime = $item->qty;
            }
            if ($item->typeID == 2) {
                $this->amount = $item->qty;
            }
            if ($item->typeID == 3) {
                $this->perpcs = $item->qty;
            }
            if ($item->typeID == 4) {
                $this->rate = $item->qty;
            }
            $z++;
            if ($z == 4) {
                $status = CheckStatusInfo::find()->select(['name'])->where(['statusid' => $item->checkconfirm])->one();
//                switch ($item->checkconfirm) {
//                    case 0:
//                        $text = '<span class="label label-info">' . $status->name . '</span>';
//                        break;
//                    case  1:
//                        $text = '<span class="label label-success">' . $status->name . '</span>';
//                        break;
//                }
                $chk = new UserDirect();
                $usr = $chk->ChkusrForPT();
                if ($usr == 'IT' || $usr == 'PS') {
                    $sys = 1;
                } else {
                    $sys = 0;
                }
                array_push($array, [
                    'empid' => $item->empid,
                    'empname' => $item->empName,
                    'date' => $item->date,
                    'stoveid' => $item->stoveid,
                    'standard' => $item->standard,
                    'hour' => $item->hour,
                    'amount' => $this->amount,
                    'losttime' => $this->losttime,
                    'totaltire' => $item->totaltire,
                    'priceperpcs' => $this->perpcs,
                    'rate' => $this->rate,
                    'deduct' => $item->deduct,
//                    'check' => $text,
                    'check' => $status->name,
                    'role' => $sys
                ]);
                $z = 0;
            }
        }
        // add conditions that should always apply here

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'standard', 'hour', 'check'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function showcreated()
    {
        $query = BOMInfo::find()->where(['checkconfirm' => '0'])
            ->orderBy(['date' => SORT_ASC, 'stoveid' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $item) {
            if ($item->typeID == 1) {
                $this->losttime = $item->qty;
            }
            if ($item->typeID == 2) {
                $this->amount = $item->qty;
            }
            if ($item->typeID == 3) {
                $this->perpcs = $item->qty;
            }
            if ($item->typeID == 4) {
                $this->rate = $item->qty;
            }
            $z++;
            if ($z == 4) {
                $status = CheckStatusInfo::find()->select(['name'])->where(['statusid' => $item->checkconfirm])->one();
//                switch ($item->checkconfirm) {
//                    case 0:
//                        $text = '<span class="label label-info">' . $status->name . '</span>';
//                        break;
//                    case  1:
//                        $text = '<span class="label label-success">' . $status->name . '</span>';
//                        break;
//                }
                $chk = new UserDirect();
                $usr = $chk->ChkusrForPT();
                if ($usr == 'IT' || $usr == 'PS') {
                    $sys = 1;
                } else {
                    $sys = 0;
                }
                array_push($array, [
                    'empid' => $item->empid,
                    'empname' => $item->empName,
                    'date' => $item->date,
                    'stoveid' => $item->stoveid,
                    'standard' => $item->standard,
                    'hour' => $item->hour,
                    'amount' => $this->amount,
                    'losttime' => $this->losttime,
                    'totaltire' => $item->totaltire,
                    'priceperpcs' => $this->perpcs,
                    'rate' => $this->rate,
                    'deduct' => $item->deduct,
//                    'check' => $text,
                    'check' => $status->name,
                    'role' => $sys
                ]);
                $z = 0;
            }
        }
        // add conditions that should always apply here

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'standard', 'hour', 'check'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public static function ConvertDate($val)
    {
        return str_replace("/","-",$val);
    }
}
