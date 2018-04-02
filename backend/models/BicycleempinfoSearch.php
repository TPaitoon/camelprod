<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BicycleEmpInfo;
use yii\data\ArrayDataProvider;

/**
 * BicycleempinfoSearch represents the model behind the search form about `common\models\BicycleEmpInfo`.
 */
class BicycleempinfoSearch extends BicycleEmpInfo
{
    public $startdate, $enddate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'confirms'], 'integer'],
            [['empid', 'empName', 'rank', 'Extra', 'date'], 'safe'],
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
            $this->startdate = date('Y-m-d');
            $this->enddate = date('Y-m-d');
        }

        $this->load($params);

        $query = BicycleEmpInfo::find()->andFilterWhere(['and', ['like', 'empid', $this->empid], ['>=', 'date', $this->startdate], ['<=', 'date', $this->enddate]])->orderBy(['date' => SORT_ASC]);

        // add conditions that should always apply here

        $array = [];
        foreach ($query->all() as $item) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForBicycletire();
            $usr == 'ITIT' || $usr == 'PSPS' ? $sys = 1 : $sys = 0;
            array_push($array, [
                'id' => $item->id,
                'empid' => $item->empid,
                'empName' => $item->empName,
                'rank' => $item->rank,
                'Extra' => $item->Extra,
                'date' => $item->date,
                'confirms' => $item->confirms,
                'role' => $sys
            ]);
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empName', 'date', 'confirms'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $dataProvider;
    }

    public function showcreated()
    {
        $query = BicycleEmpInfo::find()->where(['confirms' => 0])->orderBy(['date' => SORT_ASC]);
        $array = [];
        foreach ($query->all() as $item) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForBicycletire();
            $usr == 'ITIT' || $usr == 'PSPS' ? $sys = 1 : $sys = 0;
            array_push($array, [
                'id' => $item->id,
                'empid' => $item->empid,
                'empName' => $item->empName,
                'rank' => $item->rank,
                'Extra' => $item->Extra,
                'date' => $item->date,
                'confirms' => $item->confirms,
                'role' => $sys
            ]);
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empName', 'date', 'confirms'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $dataProvider;
    }
}
