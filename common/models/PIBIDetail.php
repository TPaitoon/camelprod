<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIDetail".
 *
 * @property integer $id
 * @property integer $Shiftid
 * @property integer $Groupid
 * @property string $Empid
 * @property string $Empname
 * @property string $Date
 * @property integer $Hour
 * @property integer $Itemid
 * @property integer $Typeid
 * @property double $TQty
 * @property integer $Deductid
 * @property double $DQty
 * @property integer $Rate
 * @property integer $Refid
 */
class PIBIDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIDetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Shiftid', 'Groupid', 'Hour', 'Itemid', 'Typeid', 'Deductid', 'Rate', 'Refid'], 'integer'],
            [['Empid', 'Empname'], 'string'],
            [['Date'], 'safe'],
            [['TQty', 'DQty'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Shiftid' => 'Shiftid',
            'Groupid' => 'Groupid',
            'Empid' => 'Empid',
            'Empname' => 'Empname',
            'Date' => 'Date',
            'Hour' => 'Hour',
            'Itemid' => 'Itemid',
            'Typeid' => 'Typeid',
            'TQty' => 'Tqty',
            'Deductid' => 'Deductid',
            'DQty' => 'Dqty',
            'Rate' => 'Rate',
            'Refid' => 'Refid',
        ];
    }
}
