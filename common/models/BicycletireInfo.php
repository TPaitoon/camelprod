<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_qtytirebicycle".
 *
 * @property integer $tireid
 * @property string $empid
 * @property string $empName
 * @property integer $typeID
 * @property double $qty
 * @property string $date
 * @property string $standard
 * @property string $hour
 * @property integer $checkconfirm
 * @property string $stickername
 * @property string $totaltire
 */
class BicycletireInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_qtytirebicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empName', 'standard', 'hour', 'stickername', 'totaltire'], 'string'],
            [['typeID', 'checkconfirm'], 'integer'],
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
            'tireid' => 'Tireid',
            'empid' => 'Empid',
            'empName' => 'Emp Name',
            'typeID' => 'Type ID',
            'qty' => 'Qty',
            'date' => 'Date',
            'standard' => 'Standard',
            'hour' => 'Hour',
            'checkconfirm' => 'Checkconfirm',
            'stickername' => 'Stickername',
            'totaltire' => 'Totaltire',
        ];
    }
}
