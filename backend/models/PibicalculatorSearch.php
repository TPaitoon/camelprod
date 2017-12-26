<?php

namespace backend\models;

use common\models\CheckStatusInfo;
use common\models\ShiftList;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PIBICalculator;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PibicalculatorSearch represents the model behind the search form about `backend\models\PIBICalculator`.
 */
class PibicalculatorSearch extends PIBICalculator
{
    public $startdate, $enddate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group', 'shift', 'status'], 'integer'],
            [['date', 'startdate', 'enddate'], 'safe'],
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
        if ($this->startdate && $this->enddate == '') {
            $this->startdate && $this->enddate = date('Y-m-d');
        }

        $this->load($params);

        $query = PIBICalculator::find()->andFilterWhere([
            'and',
            ['like', 'shift', $this->shift],
            ['>=', 'date', $this->startdate],
            ['<=', 'date', $this->enddate]
        ]);

        // add conditions that should always apply here
        $array = [];
        foreach ($query->all() as $item) {
            $mdate = '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($item->date));
            $mshift = ShiftList::find()->where(['id' => $item->shift])->one();
            $mstatus = CheckStatusInfo::find()->where(['statusid' => $item->status])->one();

            if ($item->status == 0) {
//                $status = '<label class="label label-info">' . $mstatus->name . '</label>';
            } elseif ($item->status == 1) {
//                $status = '<label class="label label-success">' . $mstatus->name . '</label>';
            }
            if ($item->shift == 1) {
                $shift = '<label class="label label-primary">' . $mshift->shiftname . '</label>';
            } elseif ($item->shift == 2) {
                $shift = '<label class="label label-warning">' . $mshift->shiftname . '</label>';
            }

            $cnt = PibiDetail::find()->where(['Date' => date('Y-m-d', strtotime($item->date)), 'Shiftid' => $item->shift, 'Groupid' => $item->group])->count();
            $text = PibiDetail::find()->where(['Date' => date('Y-m-d', strtotime($item->date)), 'Shiftid' => $item->shift, 'Groupid' => $item->group])->one();

            array_push($array, [
                'id' => $item->id,
                'date' => $mdate,
                'group' => $item->group,
                'shift' => $shift,
                'cnt' => $cnt / 2,
                'hour' => $text->Hour,
//                'status' => $status,
                'status' => $mstatus->name,
            ]);
        }

        ArrayHelper::multisort($array, ['date', 'group'], SORT_ASC);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }

    public function searchcreated()
    {
        $query = PIBICalculator::find()->where(['status' => 0]);

        // add conditions that should always apply here

        $array = [];
        foreach ($query->all() as $item) {
            $mdate = '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($item->date));
            $mshift = ShiftList::find()->where(['id' => $item->shift])->one();
            $mstatus = CheckStatusInfo::find()->where(['statusid' => $item->status])->one();

            if ($item->status == 0) {
//                $status = '<label class="label label-info">' . $mstatus->name . '</label>';
            } elseif ($item->status == 1) {
//                $status = '<label class="label label-success">' . $mstatus->name . '</label>';
            }
            if ($item->shift == 1) {
                $shift = '<label class="label label-primary">' . $mshift->shiftname . '</label>';
            } elseif ($item->shift == 2) {
                $shift = '<label class="label label-warning">' . $mshift->shiftname . '</label>';
            }

            $cnt = PibiDetail::find()->where(['Date' => date('Y-m-d', strtotime($item->date)), 'Shiftid' => $item->shift, 'Groupid' => $item->group])->count();
            $text = PibiDetail::find()->where(['Date' => date('Y-m-d', strtotime($item->date)), 'Shiftid' => $item->shift, 'Groupid' => $item->group])->one();

            array_push($array, [
                'id' => $item->id,
                'date' => $mdate,
                'group' => $item->group,
                'shift' => $shift,
                'cnt' => $cnt / 2,
                'hour' => $text->Hour,
//                'status' => $status,
                'status' => $mstatus->name,
            ]);
        }

        ArrayHelper::multisort($array, ['date', 'group'], SORT_ASC);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }
}
