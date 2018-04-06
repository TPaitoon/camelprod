<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BicyclesteamworkInfo;
use yii\data\ArrayDataProvider;

/**
 * BicyclesteamworkinfoSearch represents the model behind the search form about `common\models\BicyclesteamworkInfo`.
 */
class BicyclesteamworkinfoSearch extends BicyclesteamworkInfo
{
    public $startdate, $enddate, $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsteamwork', 'confirms'], 'integer'],
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

        $query = BicyclesteamworkInfo::find()->andFilterWhere(['and', ['like', 'empid', $this->empid], ['>=', 'date', $this->startdate], ['<=', 'date', $this->enddate]])->orderBy(['date' => SORT_ASC]);

        $array = [];

        foreach ($query->all() as $item) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForPT();
            if ($usr == 'IT' || $usr == 'PS') {
                $sys = 1;
            } else {
                $sys = 0;
            }

            array_push($array,[
                'id' => $item->idsteamwork,
                'empid' => $item->empid,
                'empName' => $item->empName,
                'rank' => $item->rank,
                'Extra' => $item->Extra,
                'date' => $item->date,
                'role' => $sys,
                'confirms' => $item->confirms
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid','empName','date','confirms'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query
//        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function showcreated()
    {

        $query = BicyclesteamworkInfo::find()->where(['confirms' => 0])->orderBy(['date' => SORT_ASC]);

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query
//        ]);
        $array = [];

        foreach ($query->all() as $item) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForPT();
            if ($usr == 'IT' || $usr == 'PS') {
                $sys = 1;
            } else {
                $sys = 0;
            }

            array_push($array,[
                'id' => $item->idsteamwork,
                'empid' => $item->empid,
                'empName' => $item->empName,
                'rank' => $item->rank,
                'Extra' => $item->Extra,
                'date' => $item->date,
                'role' => $sys,
                'confirms' => $item->confirms
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid','empName','date','confirms'],
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
