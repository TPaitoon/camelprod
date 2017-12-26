<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_LoginHistory".
 *
 * @property integer $id
 * @property string $username
 * @property integer $log_at
 */
class LoginHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_LoginHistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'log_at'], 'required'],
            [['username'], 'string'],
            [['log_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'log_at' => 'Log At',
        ];
    }
}
