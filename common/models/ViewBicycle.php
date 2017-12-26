<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_ViewBicycle".
 *
 * @property string $empid
 * @property string $empname
 * @property integer $typeid
 * @property string $typename
 * @property double $qty
 * @property string $tirename
 * @property string $date
 * @property integer $minus
 */
class ViewBicycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_ViewBicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empname', 'typename', 'tirename'], 'string'],
            [['typeid', 'minus'], 'integer'],
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
            'empid' => 'Empid',
            'empname' => 'Empname',
            'typeid' => 'Typeid',
            'typename' => 'Typename',
            'qty' => 'Qty',
            'tirename' => 'Tirename',
            'date' => 'Date',
            'minus' => 'Minus',
        ];
    }
}
