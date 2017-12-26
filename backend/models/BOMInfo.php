<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 12/07/2017
 * Time: 2:44 PM
 */

namespace backend\models;

use yii\helpers\ArrayHelper;


class BOMInfo extends \common\models\BOMInfo
{
    public $losttime, $amount, $rate, $perpcs, $listid;

    public function rules()
    {
        return
            ArrayHelper::merge(parent::rules(), [
                [['losttime', 'amount', 'rate', 'deduct'], 'integer'],
                [['perpcs'], 'double'],
                [['listid'], 'string'],
                [['losttime', 'amount', 'rate', 'perpcs', 'deduct', 'empid', 'empName'], 'required'],
            ]);
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(parent::attributeLabels(), [
                'date' => 'วันที่ ',
                'losttime' => 'ค่าเสียเวลา ',
                'amount' => 'ยอดนึ่ง ',
                'deduct' => 'หักเงิน ',
                'perpcs' => 'ราคา : เส้น ',
                'rate' => 'ค่าพิเศษ ',
            ]);
    }
}