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
            $this->startdate && $this->enddate = date('Y-m-d');
        }

        $this->load($params);

        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $this->role = 1 : $this->role = 0;

        $temp = PIBITubeMaster::find()->andFilterWhere(['and', ['like', 'shift', $this->shift], ['>=', 'date', $this->startdate], ['<=', 'date', $this->enddate]])->all();
        $array = [];

        foreach ($temp as $item) {
            $data = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->all();

            $cnt = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->andFilterWhere(['empid' => $data->empid])
                ->count();

            array_push($array,[
                'id' => $item->id,
                'date' => $item->date,
                'shift' => $item->shift,
                'cnt' => count($data) / $cnt,
                'hour' => ArrayHelper::getValue($data,'0.hour'),
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
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $this->role = 1 : $this->role = 0;

        $temp = PIBITubeMaster::find()->where(['status' => 0])->all();
        $array = [];

        foreach ($temp as $item) {
            $data = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->all();

            $cnt = PIBITubeDetail::find()->where(['date' => date('Y-m-d', strtotime($item->date))])
                ->andWhere(['shift' => $item->shift])
                ->andFilterWhere(['empid' => $data->empid])
                ->count();

            array_push($array,[
                'id' => $item->id,
                'date' => $item->date,
                'shift' => $item->shift,
                'cnt' => count($data) / $cnt,
                'hour' => ArrayHelper::getValue($data,'0.hour'),
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