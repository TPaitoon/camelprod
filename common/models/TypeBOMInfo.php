<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_typebom".
 *
 * @property integer $typeID
 * @property string $typeName
 */
class TypeBOMInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_typebom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeName'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeID' => 'Type ID',
            'typeName' => 'Type Name',
        ];
    }
}
