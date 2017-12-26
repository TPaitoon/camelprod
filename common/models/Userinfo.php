<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_Userinfo".
 *
 * @property integer $id
 * @property string $Firstname
 * @property string $Lastname
 * @property string $username
 * @property string $Dept
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_Userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Firstname', 'Lastname', 'username', 'Dept'], 'required'],
            [['Firstname', 'Lastname', 'username', 'Dept'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Firstname' => 'Firstname',
            'Lastname' => 'Lastname',
            'username' => 'Username',
            'Dept' => 'Dept',
        ];
    }
}
