<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIStandardDetail".
 *
 * @property integer $id
 * @property integer $refid
 * @property integer $hour
 * @property integer $amount
 * @property integer $rate
 */
class PIBIStandardDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIStandardDetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refid', 'hour', 'amount', 'rate'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'refid' => 'Refid',
            'hour' => 'Hour',
            'amount' => 'Amount',
            'rate' => 'Rate',
        ];
    }
}
