<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBIMCEmplist;

/**
 * PibimcemplistSearch represents the model behind the search form about `common\models\PIBIMCEmplist`.
 */
class PibimcemplistSearch extends PIBIMCEmplist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shift', 'group'], 'integer'],
            [['empid'], 'safe'],
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
        $query = PIBIMCEmplist::find();

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
            'group' => $this->group,
        ]);

        $query->andFilterWhere(['like', 'empid', $this->empid]);

        return $dataProvider;
    }
}
