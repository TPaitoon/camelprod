<?php

namespace backend\models;

use common\models\EmpInfo;
use yii\base\Model;
use common\models\PIBIBCEmplist;
use yii\data\ArrayDataProvider;

/**
 * PibibcemplistSearch represents the model behind the search form about `common\models\PIBIBCEmplist`.
 */
class PibibcemplistSearch extends PIBIBCEmplist
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
     * @return ArrayDataProvider
     */
    public function searchg1()
    {
        $query = PIBIBCEmplist::findAll(["shift" => 1]);

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::findOne(["PRS_NO" => $item->empid]);
            if (empty($nml))
                $em = "<label style='color: red'>" . $item->empid . " ไม่มีข้อมูล ... </label>";
            else
                $em = $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME;
            array_push($temp, [
                "id" => $item->id,
                "shift" => $item->shift,
                "empid" => $em,
                "group" => $item->group
            ]);
        }

        $dataProviderG1 = new ArrayDataProvider([
            "allModels" => $temp,
            "pagination" => [
                "pageSize" => 5
            ]
        ]);

        return $dataProviderG1;
    }

    public function searchg2()
    {
        $query = PIBIBCEmplist::findAll(["shift" => 2]);

        $temp = [];
        foreach ($query as $item) {
            $nml = EmpInfo::findOne(["PRS_NO" => $item->empid]);
            $em = $nml->PRS_NO . ' ' . $nml->EMP_NAME . ' ' . $nml->EMP_SURNME;
            array_push($temp, [
                "id" => $item->id,
                "shift" => $item->shift,
                "empid" => $em,
                "group" => $item->group
            ]);
        }

        $dataProviderG2 = new ArrayDataProvider([
            "allModels" => $temp,
            "pagination" => [
                "pageSize" => 5
            ]
        ]);

        return $dataProviderG2;
    }
}
