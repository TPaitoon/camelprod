<?php

namespace backend\models;

use common\models\PIBIStandardDetail;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBIStandard;
use yii\data\ArrayDataProvider;

/**
 * PibistandardSearch represents the model behind the search form about `common\models\PIBIStandard`.
 */
class PibistandardSearch extends PIBIStandard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'refid'], 'integer'],
            [['name'], 'safe'],
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
        $this->load($params);

        $pibistd = PIBIStandardDetail::find()->orderBy(['refid' => SORT_ASC])->all();
        $query = [];
        foreach ($pibistd as $item) {
            $name = PIBIStandard::find()->select(['name'])->where(['refid' => $item->refid])->one();
            array_push($query,[
                'name' => $name->name,
                'hour' => $item->hour,
                'amount' => $item->amount,
                'rate' => $item->rate
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'sort' => [
                'attributes' => ['name','hour','amount','rate'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        return $dataProvider;
    }
}
