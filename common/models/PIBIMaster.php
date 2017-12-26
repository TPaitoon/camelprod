<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBIMaster".
 *
 * @property integer $id
 * @property string $date
 * @property integer $group
 * @property integer $shift
 * @property integer $status
 */
class PIBIMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBIMaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'group', 'shift', 'status'], 'required'],
            [['date'], 'safe'],
            [['group', 'shift', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'group' => 'Group',
            'shift' => 'Shift',
            'status' => 'Status',
        ];
    }
}
