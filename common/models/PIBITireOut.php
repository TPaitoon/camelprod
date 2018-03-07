<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBITireOut".
 *
 * @property integer $id
 * @property string $empid
 * @property string $empname
 * @property integer $shift
 * @property string $date
 * @property integer $qty
 * @property integer $status
 */
class PIBITireOut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBITireOut';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empname'], 'string'],
            [['shift', 'qty', 'status'], 'integer'],
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
            'empname' => 'Empname',
            'shift' => 'Shift',
            'date' => 'Date',
            'qty' => 'Qty',
            'status' => 'Status',
        ];
    }
}
