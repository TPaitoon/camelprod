<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 06/07/2017
 * Time: 2:43 PM
 */

namespace backend\models;

class ExtraInfo extends \common\models\ExtraInfo
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ExtraName' => 'มาตรฐาน',
            'extra_id' => 'รหัสอ้างอิง',
            'Values' => 'จำนวนนาที'
        ];
    }

    /* Update 11/07/2017 */
    /*public function getExtradetails()
    {
        return $this->hasOne(ExtraDetailInfo::className(),['extra_id' => 'extra_id']);
    }*/
}