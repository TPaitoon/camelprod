<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIMCStandardDetail".
 *
 * @property integer $id
 * @property integer $refid
 * @property integer $hour
 * @property integer $amount
 * @property integer $rate
 */
class PIBIMCStandardDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIMCStandardDetail';
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
