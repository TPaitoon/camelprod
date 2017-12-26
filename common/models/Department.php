<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_Department".
 *
 * @property integer $id
 * @property string $deptid
 * @property string $deptdesc
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_Department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deptid', 'deptdesc'], 'required'],
            [['deptid', 'deptdesc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'deptid' => 'Deptid',
            'deptdesc' => 'Deptdesc',
        ];
    }
}
