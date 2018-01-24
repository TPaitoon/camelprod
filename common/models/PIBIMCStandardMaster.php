<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIMCStandardMaster".
 *
 * @property integer $id
 * @property string $name
 * @property integer $refid
 */
class PIBIMCStandardMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIMCStandardMaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'refid'], 'required'],
            [['name'], 'string'],
            [['refid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'refid' => 'Refid',
        ];
    }
}
