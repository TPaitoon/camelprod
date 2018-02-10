<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBITubeEmplist".
 *
 * @property integer $id
 * @property integer $shift
 * @property string $date
 * @property string $empid
 */
class PIBITubeEmplist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBITubeEmplist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shift'], 'integer'],
            [['date'], 'safe'],
            [['empid'], 'string'],
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
            'empid' => 'Empid',
        ];
    }
}
