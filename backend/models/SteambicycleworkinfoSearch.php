<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SteambicycleworkInfo;

/**
 * SteambicycleworkinfoSearch represents the model behind the search form about `common\models\SteambicycleworkInfo`.
 */
class SteambicycleworkinfoSearch extends SteambicycleworkInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idwork', 'amount'], 'integer'],
            [['section'], 'safe'],
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
        $query = SteambicycleworkInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idwork' => $this->idwork,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'section', $this->section]);

        return $dataProvider;
    }
}
