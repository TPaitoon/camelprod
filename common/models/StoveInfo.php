<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_stove".
 *
 * @property integer $id
 * @property string $Stove
 */
class StoveInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_stove';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['Stove'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Stove' => 'Stove',
        ];
    }
}
