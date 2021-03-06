<?php

namespace backend\models;

use common\models\CheckStatusInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BicycletireInfo;
use yii\data\ArrayDataProvider;

/**
 * BicycletireinfoSearch represents the model behind the search form about `common\models\BicycletireInfo`.
 */
class BicycletireinfoSearch extends BicycletireInfo
{
    public $startdate, $enddate, $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tireid', 'typeID', 'checkconfirm'], 'integer'],
            [['empid', 'empName', 'date', 'standard', 'hour', 'stickername', 'totaltire'], 'safe'],
            [['qty'], 'number'],
            [['startdate', 'enddate'], 'safe'],
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
        if ($this->startdate == '' && $this->enddate == '') {
            $this->startdate = date('d/m/Y');
            $this->enddate = date('d/m/Y');
        }

        $this->load($params);

        $query = BicycletireInfo::find()->andFilterWhere(['and', ['like', 'empid', $this->empid], ['>=', 'date', self::ConvertDate($this->startdate)], ['<=', 'date', self::ConvertDate($this->enddate)]])->orderBy(['date' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $value) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForPT();
            if ($usr == 'IT' || $usr == 'PS') {
                $sys = 1;
            } else {
                $sys = 0;
            }
            switch ($value->typeID) {
                case 1:
                    $this->losttime = $value->qty;
                    break;
                case 2:
                    $this->tireamount1 = $value->qty;
                    break;
                case 3:
                    $this->tireperpcs = $value->qty;
                    break;
                case 4:
                    $this->tirerate1 = $value->qty;
                    break;
                case 5:
                    $this->tireamount2 = $value->qty;
                    break;
                case 6:
                    $this->tirerate2 = $value->qty;
                    break;
                case 7:
                    $this->stickeramount = $value->qty;
                    break;
                case 8:
                    $this->stickerperpcs = $value->qty;
                    break;
                case 9:
                    $this->stickerrate = $value->qty;
                    break;
                case 10:
                    $this->deduct = $value->qty;
                    break;
                case 11:
                    $this->totalrate = $value->qty;
                    break;
            }
            $z++;
            if ($z == 11) {
                array_push($array, [
                    'empid' => $value->empid,
                    'empname' => $value->empName,
                    'date' => $value->date,
                    'hour' => $value->hour,
                    'standard' => $value->standard,
                    'tireamount1' => $this->tireamount1,
                    'losttime' => $this->losttime,
                    'totaltire1' => $value->totaltire,
                    'tireperpcs' => $this->tireperpcs,
                    'tirerate1' => $this->tirerate1,
                    'tireamount2' => $this->tireamount2,
                    'tirerate2' => $this->tirerate2,
                    'stickeramount' => $this->stickeramount,
                    'stickername' => $value->stickername,
                    'stickerperpcs' => $this->stickerperpcs,
                    'stickerrate' => $this->stickerrate,
                    'deduct' => $this->deduct,
                    'totalrate' => $this->totalrate,
                    'check' => $value->checkconfirm,
                    'role' => $sys
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'standard', 'stickername', 'check'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function showcreated()
    {

        $query = BicycletireInfo::find()->where(['checkconfirm' => 0])->orderBy(['date' => SORT_ASC]);

        $array = [];
        $z = 0;

        foreach ($query->all() as $value) {
            $chk = new UserDirect();
            $usr = $chk->ChkusrForPT();
            if ($usr == 'IT' || $usr == 'PS') {
                $sys = 1;
            } else {
                $sys = 0;
            }
            switch ($value->typeID) {
                case 1:
                    $this->losttime = $value->qty;
                    break;
                case 2:
                    $this->tireamount1 = $value->qty;
                    break;
                case 3:
                    $this->tireperpcs = $value->qty;
                    break;
                case 4:
                    $this->tirerate1 = $value->qty;
                    break;
                case 5:
                    $this->tireamount2 = $value->qty;
                    break;
                case 6:
                    $this->tirerate2 = $value->qty;
                    break;
                case 7:
                    $this->stickeramount = $value->qty;
                    break;
                case 8:
                    $this->stickerperpcs = $value->qty;
                    break;
                case 9:
                    $this->stickerrate = $value->qty;
                    break;
                case 10:
                    $this->deduct = $value->qty;
                    break;
                case 11:
                    $this->totalrate = $value->qty;
                    break;
            }
            $z++;
            if ($z == 11) {
                array_push($array, [
                    'empid' => $value->empid,
                    'empname' => $value->empName,
                    'date' => $value->date,
                    'hour' => $value->hour,
                    'standard' => $value->standard,
                    'tireamount1' => $this->tireamount1,
                    'losttime' => $this->losttime,
                    'totaltire1' => $value->totaltire,
                    'tireperpcs' => $this->tireperpcs,
                    'tirerate1' => $this->tirerate1,
                    'tireamount2' => $this->tireamount2,
                    'tirerate2' => $this->tirerate2,
                    'stickeramount' => $this->stickeramount,
                    'stickername' => $value->stickername,
                    'stickerperpcs' => $this->stickerperpcs,
                    'stickerrate' => $this->stickerrate,
                    'deduct' => $this->deduct,
                    'totalrate' => $this->totalrate,
                    'check' => $value->checkconfirm,
                    'role' => $sys
                ]);
                $z = 0;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['empid', 'empname', 'date', 'standard', 'stickername', 'check'],
                'defaultOrder' => SORT_ASC,
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public static function ConvertDate($val)
    {
        $_temp = str_replace("/", "-", $val);
        return date('Y-m-d', strtotime($_temp));
    }
}
