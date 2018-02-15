<?php

namespace backend\models;

use common\models\EmpInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBITubeEmplist;
use yii\data\ArrayDataProvider;

/**
 * PibitubeemplistSearch represents the model behind the search form about `common\models\PIBITubeEmplist`.
 */
class PibitubeemplistSearch extends PIBITubeEmplist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shift'], 'integer'],
            [['date', 'empid'], 'safe'],
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
    public function searchg1()
    {
        $query = PIBITubeEmplist::find()->where(['shift' => 1])->all();

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::find()->where(['PRS_NO' => $item->empid])->one();
            array_push($temp,[
                'shift' => $item->shift,
                'empid' => $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME,
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $temp
        ]);

        return $dataProvider;
    }

    public function searchg2()
    {
        $query = PIBITubeEmplist::find()->where(['shift' => 2])->all();

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::find()->where(['PRS_NO' => $item->empid])->one();
            array_push($temp, [
                'shift' => $item->shift,
                'empid' => $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME,
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $temp
        ]);

        return $dataProvider;
    }
}
