<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BicycleEmpInfo;

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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
        $query = BicycleEmpInfo::find()->where(['confirms' => 0])->orderBy(['date' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
