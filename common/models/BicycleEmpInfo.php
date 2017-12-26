<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRS_bicycleorderdetail".
 *
 * @property integer $id
 * @property string $empid
 * @property string $empName
 * @property string $rank
 * @property string $Extra
 * @property string $date
 * @property integer $confirms
 */
class BicycleEmpInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRS_bicycleorderdetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empid', 'empName', 'rank', 'Extra'], 'string'],
            [['date'], 'safe'],
            [['confirms'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empid' => 'Empid',
            'empName' => 'Emp Name',
            'rank' => 'Rank',
            'Extra' => 'Extra',
            'date' => 'Date',
            'confirms' => 'Confirms',
        ];
    }
}
