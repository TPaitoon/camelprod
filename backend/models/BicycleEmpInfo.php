<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 19/07/2017
 * Time: 3:57 PM
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class BicycleEmpInfo extends \common\models\BicycleEmpInfo
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['empid', 'empName', 'rank'], 'required']
        ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empid' => 'รหัสพนักงาน',
            'empName' => 'ชื่อ - นามสกุล',
            'rank' => 'ตำแหน่ง',
            'Extra' => 'เงินพิเศษ',
            'date' => 'วันที่',
            'confirms' => 'สถานะ',
        ];
    }
}