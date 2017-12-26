<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 2560/08/01
 * Time: 09:11:12
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class BicycletireInfo extends \common\models\BicycletireInfo
{

    public $losttime, $tireamount1, $tireperpcs, $tirerate1, $tireamount2, $tirerate2, $stickeramount, $stickerperpcs, $stickerrate, $deduct, $totalrate;

    #$name = $typeID
    #$losttime = 1
    #$tireamount1 = 2
    #$tireperpcs = 3
    #$tirerate1 = 4
    #$tireamount2 = 5
    #$tirerate2 = 6
    #$stickeramount = 7
    #$stickerperpcs = 8
    #$stickerrate = 9
    #$deduct = 10
    #$totalrate = 11

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['losttime', 'tireamount1', 'tireamount2', 'stickeramount', 'deduct', 'totalrate'], 'required'],
            [['tireperpcs', 'tirerate1', 'tirerate2', 'stickerperpcs', 'stickerrate'], 'safe']
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'empid' => 'รหัสพนักงาน',
            'empName' => 'ชื่อ - นามสกุล',
            'date' => 'วันที่',
            'standard' => 'มาตรฐาน',
            'hour' => 'ชั่วโมงงาน',
            'checkconfirm' => 'สถานะ',
            'stickername' => 'รายชื่อสติกเกอร์',
            'totaltire' => 'ยอดยาง',
            'losttime' => 'เสียเวลา : นาที',
            'tireamount1' => 'ยอดนึ่งเตาที่ 1',
            'tireamount2' => 'ยอดเตาที่ 2',
            'stickeramount' => 'จำนวณสติกเกอร์',
            'deduct' => 'หักยางเสีย',
        ]);
    }
}