<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 25/01/2018
 * Time: 14:49 PM
 */

namespace backend\models;


use common\models\PIBIMCDetail;
use common\models\PIBIMCMaster;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class PibimccalculatorSearch extends PIBIMCMaster
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

        $_temp = PIBIMCMaster::find()->andFilterWhere([
            'and', ['like', 'shift', $this->shift], ['>=', 'date', $this->startdate],
            ['<=', 'date', $this->enddate]
        ])->all();
        $_array = [];

        foreach ($_temp as $i) {
            $_data = PIBIMCDetail::find()->where(['date' => date('Y-m-d', strtotime($i->date))])
                ->andWhere(['shiftid' => $i->shift, 'groupid' => $i->group])
                ->all();

            array_push($_array, [
                'id' => $i->id,
                'date' => $i->date,
                'group' => $i->group,
                'shift' => $i->shift,
                'cnt' => count($_data) / 4,
                'hour' => ArrayHelper::getValue($_data, '0.hour'),
                'status' => $i->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($_array, ['date', 'group'], 4);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $_array
        ]);

        return $dataProvider;
    }

    public function searchcreated()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();
        $usr == 'ITIT' || $usr == 'PSPS' ? $this->role = 1 : $this->role = 0;

        $_temp = PIBIMCMaster::find()->where(['status' => 0])->all();
        $_array = [];

        foreach ($_temp as $i) {
            $_data = PIBIMCDetail::find()->where(['date' => date('Y-m-d', strtotime($i->date))])
                ->andWhere(['shiftid' => $i->shift, 'groupid' => $i->group])
                ->all();

            array_push($_array, [
                'id' => $i->id,
                'date' => $i->date,
                'group' => $i->group,
                'shift' => $i->shift,
                'cnt' => count($_data) / 4,
                'hour' => ArrayHelper::getValue($_data, '0.hour'),
                'status' => $i->status,
                'role' => $this->role
            ]);
        }

        ArrayHelper::multisort($_array, ['date', 'group'], 4);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $_array
        ]);

        return $dataProvider;
    }

}