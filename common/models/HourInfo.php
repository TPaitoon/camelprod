<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_hour".
 *
 * @property integer $id
 * @property string $hour
 * @property string $hourqty
 * @property string $hourwork
 * @property integer $values
 */
class HourInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_hour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'values'], 'integer'],
            [['hour', 'hourqty', 'hourwork'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hour' => 'Hour',
            'hourqty' => 'Hourqty',
            'hourwork' => 'Hourwork',
            'values' => 'Values',
        ];
    }
}
