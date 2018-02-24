<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBITireOut;

/**
 * PibitireoutSearch represents the model behind the search form about `common\models\PIBITireOut`.
 */
class PibitireoutSearch extends PIBITireOut
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shift', 'qty', 'status'], 'integer'],
            [['empid', 'empname'], 'safe'],
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
        $query = PIBITireOut::find();

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
            'id' => $this->id,
            'shift' => $this->shift,
            'qty' => $this->qty,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'empid', $this->empid])
            ->andFilterWhere(['like', 'empname', $this->empname]);

        return $dataProvider;
    }
}
