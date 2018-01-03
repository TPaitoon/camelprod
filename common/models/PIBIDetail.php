<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIDetail".
 *
 * @property integer $id
 * @property integer $Groupid
 * @property integer $Shiftid
 * @property string $Empid
 * @property string $Date
 * @property integer $Hour
 * @property integer $Typeid
 * @property double $Qty
 * @property integer $Itemid
 * @property double $Deduct
 * @property integer $Totaltire
 * @property integer $refid
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
            [['Groupid', 'Shiftid', 'Empid', 'Date', 'Hour', 'Typeid', 'Qty', 'Itemid', 'Deduct', 'Totaltire','refid'], 'required'],
            [['Groupid', 'Shiftid', 'Hour', 'Typeid', 'Itemid', 'Totaltire','refid'], 'integer'],
            [['Empid'], 'string'],
            [['Date'], 'safe'],
            [['Qty', 'Deduct'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Groupid' => 'Groupid',
            'Shiftid' => 'Shiftid',
            'Empid' => 'Empid',
            'Date' => 'Date',
            'Hour' => 'Hour',
            'Typeid' => 'Typeid',
            'Qty' => 'Qty',
            'Itemid' => 'Itemid',
            'Deduct' => 'Deduct',
            'Totaltire' => 'Totaltire',
        ];
    }
}
