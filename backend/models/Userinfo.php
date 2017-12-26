<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 2560/08/11
 * Time: 09:28:51
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class Userinfo extends \common\models\Userinfo
{
    public $password, $email, $name;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['password', 'email', 'name'], 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'Firstname' => 'ชื่อ',
            'Lastname' => 'นามสกุล',
            'username' => 'ชื่อผู้ใช้งาน',
            'password' => 'รหัสผ่าน',
            'Dept' => 'แผนก',
            'name' => 'ชื่อ - นามสกุล'
        ]);
    }
}