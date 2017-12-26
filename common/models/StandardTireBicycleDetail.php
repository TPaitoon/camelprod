<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_standardtirebicycledetail".
 *
 * @property integer $id
 * @property string $steamName
 * @property integer $idexbicycle
 * @property integer $hourwork
 * @property integer $valuemin
 * @property integer $valuemax
 * @property double $rate
 */
class StandardTireBicycleDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_standardtirebicycledetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['steamName'], 'string'],
            [['idexbicycle', 'hourwork', 'valuemin', 'valuemax'], 'integer'],
            [['rate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'steamName' => 'Steam Name',
            'idexbicycle' => 'Idexbicycle',
            'hourwork' => 'Hourwork',
            'valuemin' => 'Valuemin',
            'valuemax' => 'Valuemax',
            'rate' => 'Rate',
        ];
    }
}
