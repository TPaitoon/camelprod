<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_qtybicycle".
 *
 * @property integer $id
 * @property string $empid
 * @property string $empname
 * @property integer $typeid
 * @property double $qty
 * @property string $tirename
 * @property string $date
 * @property integer $checks
 * @property integer $minus
 * @property integer $grouptire
 */
class BicycleInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_qtybicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empname', 'tirename'], 'string'],
            [['typeid', 'checks', 'minus', 'grouptire'], 'integer'],
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
            'empname' => 'Empname',
            'typeid' => 'Typeid',
            'qty' => 'Qty',
            'tirename' => 'Tirename',
            'date' => 'Date',
            'checks' => 'Checks',
            'minus' => 'Minus',
            'grouptire' => 'Grouptire',
        ];
    }
}
