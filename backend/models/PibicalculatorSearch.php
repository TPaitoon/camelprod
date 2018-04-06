<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 22/01/2018
 * Time: 13:59 PM
 */

namespace backend\models;


use common\models\ShiftList;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class PibicalculatorSearch extends PIBICalculator
{
    public $startdate, $enddate, $role;

    public function rules()
    {
        return [
            [['id', 'group', 'shift', 'status'], 'integer'],
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

        $query = PIBICalculator::find()
            ->andFilterWhere(['and',
                ['like', 'shift', $this->shift],
                ['>=', 'date', $this->startdate],
                ['<=', 'date', $this->enddate]])
            ->all();

        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $this->role = 1 : $this->role = 0;
        $array = [];

        foreach ($query as $i) {
            $data = PIBIDetail::find()->where(['Date' => date('Y-m-d', strtotime($i->date))])
                ->andWhere(['Shiftid' => $i->shift, 'Groupid' => $i->group])
                ->all();

            array_push($array, [
                'id' => $i->id,
                'date' => $i->date,
                'group' => $i->group,
                'shift' => $i->shift,
                'cnt' => count($data) / 4,
                'hour' => ArrayHelper::getValue($data, '0.Hour'),
                'status' => $i->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($array, ['date', 'group'], SORT_ASC);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }

    public function searchcreated()
    {
        $query = PIBICalculator::find()->where(['status' => 0])->all();
        $array = [];
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $role = 1 : $role = 0;

        foreach ($query as $i) {
            $data = PIBIDetail::find()->where(['Date' => date('Y-m-d', strtotime($i->date))])
                ->andWhere(['Shiftid' => $i->shift, 'Groupid' => $i->group])
                ->all();

            array_push($array, [
                'id' => $i->id,
                'date' => $i->date,
                'group' => $i->group,
                'shift' => $i->shift,
                'cnt' => count($data) / 4,
                'hour' => ArrayHelper::getValue($data, '0.Hour'),
                'status' => $i->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($array, ['date', 'group'], SORT_ASC);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $array
        ]);

        return $dataProvider;
    }
}