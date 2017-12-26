<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Weaverbicycle;

/**
 * WeaverbicycleSearch represents the model behind the search form about `common\models\Weaverbicycle`.
 */
class WeaverbicycleSearch extends Weaverbicycle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'groups'], 'integer'],
            [['sizename'], 'safe'],
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
        $query = Weaverbicycle::find();

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
            'groups' => $this->groups,
        ]);

        $query->andFilterWhere(['like', 'sizename', $this->sizename]);

        return $dataProvider;
    }

    public function searchtire()
    {
        $querys = Weaverbicycle::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $querys
        ]);
        return $dataProvider;
    }
}
