<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usrp_pibitubemaster".
 *
 * @property integer $id
 * @property integer $shift
 * @property string $date
 * @property integer $status
 */
class PIBITubeMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usrp_pibitubemaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shift', 'status'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shift' => 'Shift',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}
