<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PIBITIRECUTDETAIL".
 *
 * @property integer $id
 * @property string $empno
 * @property string $empname
 * @property string $date
 * @property integer $stdid
 * @property integer $status
 */
class PIBITIRECUTDETAIL extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PIBITIRECUTDETAIL';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empno', 'empname', 'date', 'stdid'], 'required'],
            [['empno', 'empname'], 'string'],
            [['date'], 'safe'],
            [['stdid', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empno' => 'Empno',
            'empname' => 'Empname',
            'date' => 'Date',
            'stdid' => 'Stdid',
            'status' => 'Status',
        ];
    }
}
