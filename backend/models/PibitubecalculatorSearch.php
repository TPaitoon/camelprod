<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 03/02/2018
 * Time: 13:38
 */

namespace backend\models;

use common\models\PIBITubeDetail;
use common\models\PIBITubeMaster;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class PibitubecalculatorSearch extends PIBITubeMaster
{
    public $startdate, $enddate, $role;

    public function rules()
    {
        return [
            [['id', 'shift', 'group', 'status'], 'integer'],
            [['date', 'startdate', 'enddate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        if (empty($this->startdate) && empty($this->enddate)) {
            $this->startdate && $this->enddate = date('d/m/Y');
        }

        $this->load($params);

        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $this->role = 1 : $this->role = 0;

        $temp = PIBITubeMaster::find()->andFilterWhere(['and', ['like', 'shift', $this->shift], ['>=', 'date', Scripts::ConvertDateDMYtoYMDforSQL($this->startdate)], ['<=', 'date', Scripts::ConvertDateDMYtoYMDforSQL($this->enddate)]])->all();
        $array = [];

        foreach ($temp as $item) {
            $data = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->all();

            $cnt = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->andFilterWhere(['empid' => ArrayHelper::getValue($data,'0.empid')])
                ->count();

            array_push($array,[
                'id' => $item->id,
                'date' => $item->date,
                'shift' => $item->shift,
//                'cnt' => count($data) / $cnt,
                'status' => $item->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($array,['date','shift'],4);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }

    public function searchcreated()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $this->role = 1 : $this->role = 0;

        $temp = PIBITubeMaster::find()->where(['status' => 0])->all();
        $array = [];

        foreach ($temp as $item) {
            $data = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->all();

            $cnt = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->andFilterWhere(['empid' => ArrayHelper::getValue($data,'0.empid')])
                ->count();

            array_push($array,[
                'id' => $item->id,
                'date' => $item->date,
                'shift' => $item->shift,
//                'cnt' => count($data) / $cnt,
                'status' => $item->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($array,['date','shift'],4);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }
}