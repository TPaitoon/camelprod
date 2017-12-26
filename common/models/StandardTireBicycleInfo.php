<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_standardtirebicycle".
 *
 * @property integer $id
 * @property string $standardname
 * @property integer $idexbicycle
 * @property integer $class
 * @property integer $min
 */
class StandardTireBicycleInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_standardtirebicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['standardname'], 'string'],
            [['idexbicycle', 'class', 'min'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'standardname' => 'Standardname',
            'idexbicycle' => 'Idexbicycle',
            'class' => 'Class',
            'min' => 'Min',
        ];
    }
}
