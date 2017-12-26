<?php

namespace backend\models;

use common\models\ExtradetailInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use backend\models\ExtraInfo;
use yii\data\ArrayDataProvider;

/**
 * ExtrainfoSearch represents the model behind the search form about `backend\models\ExtraInfo`.
 */
class ExtrainfoSearch extends ExtraInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Values'], 'integer'],
            [['ExtraName', 'extra_id'], 'safe'],
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
//    public function search($params)
//    {
//        $query = ExtraInfo::find();
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'Values' => $this->Values,
//        ]);
//
//        $query->andFilterWhere(['like', 'ExtraName', $this->ExtraName])
//            ->andFilterWhere(['like', 'extra_id', $this->extra_id]);
//
//        return $dataProvider;
//    }

    /**
     * @param array $params
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        // add conditions that should always apply here
        $debug = new CheckDebug();

        /* Update 10/07/2017 */
        /*$extra = ExtraInfo::find()->all();
        $rate = ExtradetailInfo::find()->all();
        $index = 0;
        $forrate = 0;
        $query = [];
        foreach ($extra as $item) {
            $chk = ExtradetailInfo::find()->where(['extra_id' => $index+1])->count();
            for ($i = 0; $i <= $chk - 1; $i++) {
                $data = ArrayHelper::getValue($rate, "$forrate" . '.Rate');
                $extradetail = ExtradetailInfo::find()->where(['Rate' => $data])->one();
                array_push($query, [
                    'id' => $extradetail->id,
                    'name' => $item->ExtraName,
                    'values' => $item->Values,
                    'min' => $extradetail->Valuemin,
                    'max' => $extradetail->valuemax,
                    'rate' => $extradetail->Rate,
                ]);
                $forrate++;
            }
            $index++;
        }
        sort($query);*/

        /* Update 11/07/2017 */
        /*$query = new Query();
        $query->select('x.id,e.ExtraName as name,e.[Values] as values,x.Valuemin as min,x.valuemax as max, x.Rate as rate')
            ->from('USRS_Extra as e')->innerJoin('USRS_ExtraDetails as x', 'e.extra_id = x.extra_id');
        $command = $query->createCommand();
        $data = $command->queryAll();
        sort($data);*/

        $extra = ExtraDetailInfo::find()->orderBy(['extra_id' => SORT_ASC])->all();
        $query = [];
        foreach ($extra as $item) {
            $name = ExtraInfo::find()->select(['ExtraName'])->where(['extra_id' => $item->extra_id])->one();
            array_push($query, [
                'id' => $item->id,
                'name' => $name->ExtraName,
                'min' => $item->Valuemin,
                'max' => $item->valuemax,
                'rate' => $item->Rate
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'sort' => [
                'attributes' => ['name','min','max','rate'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);


        return $dataProvider;
    }
    
    public function getArray() {
        $query = ExtraDetailInfo::find()->select(['extra_id','Valuemin','valuemax','Rate'])->orderBy(['extra_id' => SORT_ASC])->all();
        $array = [];
        foreach ($query as $item) {
            $name = ExtraInfo::find()->select(['ExtraName'])->where(['extra_id' => $item->extra_id])->one();
            array_push($array, [
                'name' => $name->ExtraName,
                'min' => $item->Valuemin,
                'max' => $item->valuemax,
                'rate' => $item->Rate
            ]);
        }
        return $array;
    }
}
