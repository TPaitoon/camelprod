<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBITireOut;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PibitireoutSearch represents the model behind the search form about `common\models\PIBITireOut`.
 */
class PibitireoutSearch extends PIBITireOut
{
    public $startdate, $enddate, $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shift', 'qty', 'status', 'role'], 'integer'],
            [['empid', 'empname', 'date', 'startdate', 'enddate'], 'safe'],
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
        if (empty($this->startdate) && empty($this->enddate)) {
            $this->startdate && $this->enddate = date('Y-m-d');
        }

        $this->load($params);

        $query = PIBITireOut::find()
            ->andFilterWhere(['and',
                ['like', 'shift', $this->shift],
                ['like','empid',$this->empid],
                ['>=', 'date', $this->startdate],
                ['<=', 'date', $this->enddate]
            ])
            ->all();

        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $this->role = 1 : $this->role = 0;
        $array = [];

        foreach ($query as $item) {
            array_push($array,[
                'id' => $item->id,
                'empid' => $item->empid,
                'empname' => $item->empname,
                'shift' => $item->shift,
                'date' => $item->date,
                'qty' => $item->qty,
                'status' => $item->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($array,['date','empid'],4);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }
}
