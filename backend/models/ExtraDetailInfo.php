<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 07/07/2017
 * Time: 10:49 AM
 */

namespace backend\models;

use yii\helpers\ArrayHelper;

class ExtraDetailInfo extends \common\models\ExtradetailInfo
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'extra_id' => 'รหัสอ้างอิง',
            'Valuemin' => 'ค่าต่ำสุด',
            'valuemax' => 'ค่าสูงสุด',
            'Rate' => 'ค่าพิเศษ',
        ];
    }

    public function rules()
    {
        return [
            [['extra_id', 'Valuemin', 'Rate'], 'required'],
            [['extra_id'], 'string'],
            [['Valuemin', 'valuemax'], 'integer'],
            [['Rate'], 'number'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => ExtraDetailInfo::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }
}