<?php

namespace backend\models;

use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use common\models\PIBIStandard;
use common\models\ShiftList;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pibicalculator;
use yii\data\ArrayDataProvider;

/**
 * PibicalculatorSearch represents the model behind the search form about `backend\models\Pibicalculator`.
 */
class PibicalculatorSearch extends Pibicalculator
{
    public $startdate, $enddate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Groupid', 'Shiftid', 'Hour', 'Typeid', 'Itemid', 'Totaltire', 'Status'], 'integer'],
            [['Empid', 'Date', 'startdate', 'enddate'], 'safe'],
            [['Qty', 'Deduct'], 'number'],
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
    public function showcreated()
    {
        $query = Pibicalculator::find()->where(['Status' => 0]);
        $array = [];
        $z = 0;

        foreach ($query->all() as $item) {
            if ($item->Typeid == 1) {
                $this->amount = $item->Qty;
            } elseif ($item->Typeid == 2) {
                $this->rate = $item->Qty;
            }
            $z++;
            if ($z == 2) {
                $chk = CheckStatusInfo::find()->select(['name'])->where(['statusid' => $item->Status])->one();
                $shift = ShiftList::find()->select(['shiftname'])->where(['id' => $item->Shiftid])->one();

                $emp = EmpInfo::find()->where(['PRS_NO' => $item->Empid])->one();
                $name = $emp->EMP_NAME . ' ' . $emp->EMP_SURNME;

                $std = PIBIStandard::find()->where(['refid' => $item->Itemid])->one();
//                switch ($item->Status) {
//                    case 0:
//                        $text = '<span class="label label-info">' . $chk->name . '</span>';
//                        break;
//                    case 1:
//                        $text = '<span class="label label-success">' . $chk->name . '</span>';
//                        break;
//                }
                if ($item->Status == 0) {
                    $text = '<span class="label label-info">' . $chk->name . '</span>';
                } elseif ($item->Status == 1) {
                    $text = '<span class="label label-success">' . $chk->name . '</span>';
                }
                if ($item->Shiftid == 1) {
                    $shifttext = '<span class="label label-info">' . $shift->shiftname . '</span>';
                } elseif ($item->Shiftid == 2) {
                    $shifttext = '<span class="label label-success">' . $shift->shiftname . '</span>';
                }
//                switch ($item->Shiftid) {
//                    case 1:
//                        $shifttext = '<span class="label label-info">' . $shift->shiftname . '</span>';
//                        break;
//                    case 2:
//                        $shifttext = '<span class="label label-success">' . $shift->shiftname . '</span>';
//                        break;
//                }
                array_push($array, [
                    'group' => $item->Groupid,
                    'shift' => $shifttext,
                    'empid' => $item->Empid,
                    'empname' => $name,
                    'date' => $item->Date,
                    'hour' => $item->Hour,
                    'std' => $std->name,
                    'amount' => $this->amount,
                    'totaltire' => $item->Totaltire,
                    'deduct' => $item->Deduct,
                    'rate' => $this->rate,
                    'status' => $text,
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
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

    public function search($params)
    {
        if ($this->startdate && $this->enddate === '') {
            $this->startdate && $this->enddate = date('Y-m-d');
        }
        $this->load($params);
        $query = Pibicalculator::find()->andFilterWhere(['and', ['like', 'Shiftid', $this->Shiftid], ['like', 'Empid', $this->Empid], ['>=', 'Date', $this->startdate], ['<=', 'Date', $this->enddate]]);
        $array = [];
        $z = 0;

        foreach ($query->all() as $item) {
            if ($item->Typeid == 1) {
                $this->amount = $item->Qty;
            } elseif ($item->Typeid == 2) {
                $this->rate = $item->Qty;
            }
            $z++;
            if ($z == 2) {
                $chk = CheckStatusInfo::find()->select(['name'])->where(['statusid' => $item->Status])->one();
                $shift = ShiftList::find()->select(['shiftname'])->where(['id' => $item->Shiftid])->one();

                $emp = EmpInfo::find()->where(['PRS_NO' => $item->Empid])->one();
                $name = $emp->EMP_NAME . ' ' . $emp->EMP_SURNME;

                $std = PIBIStandard::find()->where(['refid' => $item->Itemid])->one();
//                switch ($item->Status) {
//                    case 0:
//                        $text = '<span class="label label-info">' . $chk->name . '</span>';
//                        break;
//                    case 1:
//                        $text = '<span class="label label-success">' . $chk->name . '</span>';
//                        break;
//                }
                if ($item->Status == 0) {
                    $text = '<span class="label label-info">' . $chk->name . '</span>';
                } elseif ($item->Status == 1) {
                    $text = '<span class="label label-success">' . $chk->name . '</span>';
                }
                if ($item->Shiftid == 1) {
                    $shifttext = '<span class="label label-info">' . $shift->shiftname . '</span>';
                } elseif ($item->Shiftid == 2) {
                    $shifttext = '<span class="label label-success">' . $shift->shiftname . '</span>';
                }
//                switch ($item->Shiftid) {
//                    case 1:
//                        $shifttext = '<span class="label label-info">' . $shift->shiftname . '</span>';
//                        break;
//                    case 2:
//                        $shifttext = '<span class="label label-success">' . $shift->shiftname . '</span>';
//                        break;
//                }
                array_push($array, [
                    'group' => $item->Groupid,
                    'shift' => $shifttext,
                    'empid' => $item->Empid,
                    'empname' => $name,
                    'date' => $item->Date,
                    'hour' => $item->Hour,
                    'std' => $std->name,
                    'amount' => $this->amount,
                    'totaltire' => $item->Totaltire,
                    'deduct' => $item->Deduct,
                    'rate' => $this->rate,
                    'status' => $text,
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
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
}
