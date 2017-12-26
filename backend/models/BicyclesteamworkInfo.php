<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 2560/07/27
 * Time: 15:42:04
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class BicyclesteamworkInfo extends \common\models\BicyclesteamworkInfo
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['empid', 'rank'], 'required']
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'empid' => 'รหัสพนักงาน',
            'rank' => 'ตำแหน่ง',
        ]);
    }
}