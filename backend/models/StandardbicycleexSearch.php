<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StandardbicycleEx;

/**
 * StandardbicycleexSearch represents the model behind the search form about `common\models\StandardbicycleEx`.
 */
class StandardbicycleexSearch extends StandardbicycleEx
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'average', 'groups', 'amountWork', 'valueMin', 'valueMax'], 'integer'],
            [['Rate'], 'number'],
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
        $query = StandardbicycleEx::find();

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
            'average' => $this->average,
            'groups' => $this->groups,
            'amountWork' => $this->amountWork,
            'valueMin' => $this->valueMin,
            'valueMax' => $this->valueMax,
            'Rate' => $this->Rate,
        ]);

        return $dataProvider;
    }
}
