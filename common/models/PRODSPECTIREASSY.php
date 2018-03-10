<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "PRODSPECTIREASSY".
 *
 * @property string $Assy_ID
 * @property string $Assy_MC
 * @property double $Assy_Frame
 * @property double $Assy_Weight
 * @property string $ModBy
 * @property string $ModDate
 * @property string $Assy_Complete
 */
class PRODSPECTIREASSY extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PRODSPECTIREASSY';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_axlive');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Assy_ID', 'Assy_MC', 'ModBy', 'Assy_Complete'], 'string'],
            [['Assy_Frame', 'Assy_Weight'], 'number'],
            [['ModDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Assy_ID' => 'Assy  ID',
            'Assy_MC' => 'Assy  Mc',
            'Assy_Frame' => 'Assy  Frame',
            'Assy_Weight' => 'Assy  Weight',
            'ModBy' => 'Mod By',
            'ModDate' => 'Mod Date',
            'Assy_Complete' => 'Assy  Complete',
        ];
    }
}
