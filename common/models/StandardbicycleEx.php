<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_StandardbicycleEx".
 *
 * @property integer $id
 * @property integer $average
 * @property integer $groups
 * @property integer $amountWork
 * @property integer $valueMin
 * @property integer $valueMax
 * @property double $Rate
 */
class StandardbicycleEx extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_StandardbicycleEx';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['average', 'groups', 'amountWork', 'valueMin', 'valueMax'], 'integer'],
            [['Rate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'average' => 'Average',
            'groups' => 'Groups',
            'amountWork' => 'Amount Work',
            'valueMin' => 'Value Min',
            'valueMax' => 'Value Max',
            'Rate' => 'Rate',
        ];
    }
}
