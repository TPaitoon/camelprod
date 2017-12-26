<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIStandardMaster".
 *
 * @property integer $id
 * @property string $name
 * @property integer $refid
 */
class PIBIStandard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIStandardMaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
