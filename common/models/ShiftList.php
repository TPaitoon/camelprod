<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_ShiftList".
 *
 * @property integer $id
 * @property string $shiftname
 */
class ShiftList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_ShiftList';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shiftname'], 'required'],
            [['shiftname'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shiftname' => 'Shiftname',
        ];
    }
}
