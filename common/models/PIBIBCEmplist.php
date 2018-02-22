<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIBCEmplist".
 *
 * @property integer $id
 * @property integer $shift
 * @property integer $group
 * @property string $empid
 */
class PIBIBCEmplist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIBCEmplist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shift', 'group'], 'integer'],
            [['empid'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shift' => 'Shift',
            'group' => 'Group',
            'empid' => 'Empid',
        ];
    }
}
