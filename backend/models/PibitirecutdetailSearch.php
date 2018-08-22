<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBITIRECUTDETAIL;

/**
 * PibitirecutdetailSearch represents the model behind the search form about `common\models\PIBITIRECUTDETAIL`.
 */
class PibitirecutdetailSearch extends PIBITIRECUTDETAIL
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stdid'], 'integer'],
            [['empno', 'empname', 'date'], 'safe'],
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
        $query = PIBITIRECUTDETAIL::find();

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
            'date' => $this->date,
            'stdid' => $this->stdid,
        ]);

        $query->andFilterWhere(['like', 'empno', $this->empno])
            ->andFilterWhere(['like', 'empname', $this->empname]);

        return $dataProvider;
    }
}
