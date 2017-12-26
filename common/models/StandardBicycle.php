<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_Standardbicycle".
 *
 * @property integer $id
 * @property string $Section
 * @property integer $amount
 */
class StandardBicycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_Standardbicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Section'], 'string'],
            [['amount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Section' => 'Section',
            'amount' => 'Amount',
        ];
    }
}
