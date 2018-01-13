<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIDetail".
 *
 * @property integer $id
 * @property string $Empid
 * @property string $Empname
 * @property string $Date
 * @property integer $Hour
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
            [['Empid', 'Empname'], 'string'],
            [['Date'], 'safe'],
            [['Hour', 'Typeid', 'Deductid', 'Rate', 'Refid'], 'integer'],
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
            'Empid' => 'Empid',
            'Empname' => 'Empname',
            'Date' => 'Date',
            'Hour' => 'Hour',
            'Typeid' => 'Typeid',
            'TQty' => 'Tqty',
            'Deductid' => 'Deductid',
            'DQty' => 'Dqty',
            'Rate' => 'Rate',
            'Refid' => 'Refid',
        ];
    }
}
