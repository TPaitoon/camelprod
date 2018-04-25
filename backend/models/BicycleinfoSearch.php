<?php

namespace backend\models;

use backend\controllers\BicycleinfoController;
use common\models\CheckStatusInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BicycleInfo;
use yii\data\ArrayDataProvider;

/**
 * BicycleinfoSearch represents the model behind the search form about `common\models\BicycleInfo`.
 */
class BicycleinfoSearch extends BicycleInfo
{
    public $startdate, $enddate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeid', 'checks', 'minus', 'grouptire'], 'integer'],
            [['empid', 'empname', 'tirename', 'date'], 'safe'],
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

        $query = BicycleInfo::find()->andFilterWhere([
            'and',
            ['like', 'empid', $this->empid],
            ['>=', 'date', BicycleinfoController::ConvertDate($this->startdate)],
            ['<=', 'date', BicycleinfoController::ConvertDate($this->enddate)]
        ])->orderBy(['date' => SORT_ASC, 'tirename' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $value) {
            if ($value->typeid == 1) {
                $this->losttime = $value->qty;
            }
            if ($value->typeid == 2) {
                $this->amount = $value->qty;
            }
            if ($value->typeid == 3) {
                $this->perpcs = $value->qty;
            }
            if ($value->typeid == 4) {
                $this->rate = $value->qty;
            }
            $z++;
            if ($z == 4) {
                array_push($array, [
                    'empid' => $value->empid,
                    'empname' => $value->empname,
                    'date' => $value->date,
                    'tirename' => $value->tirename,
                    'grouptire' => $value->grouptire,
                    'amount' => $this->amount,
                    'losttime' => $this->losttime,
                    'minus' => $value->minus,
                    'perpcs' => $this->perpcs,
                    'rate' => $this->rate,
                    'checks' => $value->checks,
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'tirename', 'grouptire', 'perpcs', 'checks'],
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
        $query = BicycleInfo::find()->where(['checks' => 0])->orderBy(['date' => SORT_ASC, 'tirename' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $value) {
            if ($value->typeid == 1) {
                $this->losttime = $value->qty;
            }
            if ($value->typeid == 2) {
                $this->amount = $value->qty;
            }
            if ($value->typeid == 3) {
                $this->perpcs = $value->qty;
            }
            if ($value->typeid == 4) {
                $this->rate = $value->qty;
            }
            $z++;
            if ($z == 4) {
                array_push($array, [
                    'empid' => $value->empid,
                    'empname' => $value->empname,
                    'date' => $value->date,
                    'tirename' => $value->tirename,
                    'grouptire' => $value->grouptire,
                    'amount' => $this->amount,
                    'losttime' => $this->losttime,
                    'minus' => $value->minus,
                    'perpcs' => $this->perpcs,
                    'rate' => $this->rate,
                    'checks' => $value->checks,
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'tirename', 'grouptire', 'perpcs', 'checks'],
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
