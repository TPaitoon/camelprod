<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 19/07/2017
 * Time: 8:41 AM
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class StandardBicycle extends \common\models\StandardBicycle
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['Section', 'amount'], 'required'],
            [['amount'], 'integer'],
            [['Section'], 'string'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'Section' => 'ตำแหน่งงาน',
            'amount' => 'จำนวณเงิน',
        ]);
    }
}