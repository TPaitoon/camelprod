<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_Extra".
 *
 * @property integer $id
 * @property string $ExtraName
 * @property string $extra_id
 * @property integer $Values
 *
 * @property ExtraInfo $id0
 * @property ExtraInfo $extraInfo
 */
class ExtraInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_Extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ExtraName', 'extra_id'], 'string'],
            [['extra_id'], 'required'],
            [['Values'], 'integer'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => ExtraInfo::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ExtraName' => 'Extra Name',
            'extra_id' => 'Extra ID',
            'Values' => 'Values',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(ExtraInfo::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtraInfo()
    {
        return $this->hasOne(ExtraInfo::className(), ['id' => 'id']);
    }
}
