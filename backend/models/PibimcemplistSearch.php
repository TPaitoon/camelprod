<?php

namespace backend\models;

use common\models\EmpInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBIMCEmplist;
use yii\data\ArrayDataProvider;

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
    public function searchg1()
    {
        $query = PIBIMCEmplist::findAll(["shift" => 1]);

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::findOne(["PRS_NO" => $item->empid]);
            array_push($temp, [
                "shift" => $item->shift,
                "empid" => $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME,
                "group" => $item->group
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            "allModels" => $temp
        ]);

        return $dataProvider;
    }

    public function searchg2()
    {
        $query = PIBIMCEmplist::findAll(["shift" => 2]);

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::findOne(["PRS_NO" => $item->empid]);
            array_push($temp, [
                "shift" => $item->shift,
                "empid" => $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME,
                "group" => $item->group
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            "allModels" => $temp
        ]);

        return $dataProvider;
    }
}
