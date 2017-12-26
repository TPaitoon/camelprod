<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 20/07/2017
 * Time: 2:54 PM
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class BicycleInfo extends \common\models\BicycleInfo
{
    public $losttime, $amount, $rate, $perpcs, $listid;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['losttime', 'amount', 'rate'], 'integer'],
            [['perpcs'], 'double'],
            [['listid'], 'string'],
            [['losttime', 'amount', 'deduct', 'empid', 'empname', 'tirename'], 'required'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'empid' => 'รหัสพนักงาน',
            'empname' => 'ชื่อ - นามสกุล',
            'tirename' => 'รายการยาง',
            'date' => 'วันที่',
            'checks' => 'สถานะ',
            'minus' => 'ยอดยาง',
            'grouptire' => 'รหัสยาง',
        ]);
    }
}