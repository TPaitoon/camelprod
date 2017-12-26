<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_steambicyclework".
 *
 * @property integer $idwork
 * @property string $section
 * @property integer $amount
 */
class SteambicycleworkInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_steambicyclework';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section'], 'string'],
            [['amount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idwork' => 'Idwork',
            'section' => 'Section',
            'amount' => 'Amount',
        ];
    }
}
