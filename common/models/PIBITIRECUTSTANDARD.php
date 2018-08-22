<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBITIRECUTSTANDARD".
 *
 * @property integer $id
 * @property string $name
 * @property integer $rate
 */
class PIBITIRECUTSTANDARD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBITIRECUTSTANDARD';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'rate'], 'required'],
            [['name'], 'string'],
            [['rate'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'rate' => 'Rate',
        ];
    }
}
