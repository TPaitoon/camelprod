<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_Weaverbicycle".
 *
 * @property integer $id
 * @property string $sizename
 * @property integer $groups
 */
class Weaverbicycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_Weaverbicycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sizename'], 'string'],
            [['groups'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sizename' => 'Sizename',
            'groups' => 'Groups',
        ];
    }
}
