<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_CheckStatus".
 *
 * @property integer $id
 * @property integer $statusid
 * @property string $name
 */
class CheckStatusInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_CheckStatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statusid'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'statusid' => 'Statusid',
            'name' => 'Name',
        ];
    }
}
