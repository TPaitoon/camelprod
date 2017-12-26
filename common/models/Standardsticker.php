<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_standardsticker".
 *
 * @property integer $stickerid
 * @property string $stickername
 * @property double $stickerrate
 */
class Standardsticker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_standardsticker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stickername'], 'string'],
            [['stickerrate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stickerid' => 'Stickerid',
            'stickername' => 'Stickername',
            'stickerrate' => 'Stickerrate',
        ];
    }
}
