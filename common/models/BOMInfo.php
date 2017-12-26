<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_qtytype".
 *
 * @property integer $id
 * @property string $empid
 * @property string $empName
 * @property integer $typeID
 * @property double $qty
 * @property string $date
 * @property integer $stoveid
 * @property string $standard
 * @property string $hour
 * @property integer $checkconfirm
 * @property integer $deduct
 * @property integer $totaltire
 */
class BOMInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_qtytype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empName', 'standard', 'hour'], 'string'],
            [['typeID', 'stoveid', 'checkconfirm', 'deduct', 'totaltire'], 'integer'],
            [['qty'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empid' => 'Empid',
            'empName' => 'Emp Name',
            'typeID' => 'Type ID',
            'qty' => 'Qty',
            'date' => 'Date',
            'stoveid' => 'Stoveid',
            'standard' => 'Standard',
            'hour' => 'Hour',
            'checkconfirm' => 'Checkconfirm',
            'deduct' => 'Deduct',
            'totaltire' => 'Totaltire',
        ];
    }
}
