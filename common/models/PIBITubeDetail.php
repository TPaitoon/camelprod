<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBITubeDetail".
 *
 * @property integer $id
 * @property string $empid
 * @property string $empname
 * @property string $date
 * @property integer $shift
 * @property integer $itemid
 * @property integer $qty
 * @property integer $rate
 */
class PIBITubeDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBITubeDetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empname'], 'string'],
            [['date'], 'safe'],
            [['shift', 'itemid', 'qty', 'rate'], 'integer'],
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
            'date' => 'Date',
            'shift' => 'Shift',
            'itemid' => 'Itemid',
            'qty' => 'Qty',
            'rate' => 'Rate',
        ];
    }
}
