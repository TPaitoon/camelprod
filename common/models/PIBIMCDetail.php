<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIMCDetail".
 *
 * @property integer $id
 * @property integer $shiftid
 * @property integer $groupid
 * @property string $empid
 * @property string $empname
 * @property string $date
 * @property integer $hour
 * @property integer $itemid
 * @property integer $typeid
 * @property double $qty
 * @property double $deduct
 * @property integer $rate
 * @property integer $refid
 */
class PIBIMCDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIMCDetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shiftid', 'groupid', 'hour', 'itemid', 'typeid', 'refid', 'rate'], 'integer'],
            [['empid', 'empname'], 'string'],
            [['date'], 'safe'],
            [['qty', 'deduct'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shiftid' => 'Shiftid',
            'groupid' => 'Groupid',
            'empid' => 'Empid',
            'empname' => 'Empname',
            'date' => 'Date',
            'hour' => 'Hour',
            'itemid' => 'Itemid',
            'typeid' => 'Typeid',
            'qty' => 'Qty',
            'deduct' => 'Deduct',
            'refid' => 'Refid',
            'rate' => 'Rate'
        ];
    }
}
