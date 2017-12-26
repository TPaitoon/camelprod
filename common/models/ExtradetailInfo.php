<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_Extradetails".
 *
 * @property integer $id
 * @property string $extra_id
 * @property integer $Valuemin
 * @property integer $valuemax
 * @property double $Rate
 *
 * @property ExtradetailInfo $id0
 * @property ExtradetailInfo $extradetailInfo
 */
class ExtradetailInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_Extradetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extra_id'], 'required'],
            [['extra_id'], 'string'],
            [['Valuemin', 'valuemax'], 'integer'],
            [['Rate'], 'number'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => ExtradetailInfo::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'extra_id' => 'Extra ID',
            'Valuemin' => 'Valuemin',
            'valuemax' => 'Valuemax',
            'Rate' => 'Rate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(ExtradetailInfo::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtradetailInfo()
    {
        return $this->hasOne(ExtradetailInfo::className(), ['id' => 'id']);
    }
}
