<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRM_BOM_1".
 *
 * @property string $Parent_BomID
 * @property string $Parent_ItemID
 * @property string $Child_ItemID
 * @property string $Child_Qty
 * @property string $Child_WH
 * @property string $Child_UOM
 * @property string $Child_TOR
 * @property integer $BOMTYPE
 * @property string $HEIGHT
 * @property string $WIDTH
 * @property integer $ACTIVE
 * @property string $MODIFIEDDATETIME
 * @property string $Desc2
 */
class BOM1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRM_BOM_1';
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
            [['Parent_BomID', 'Parent_ItemID', 'Child_ItemID', 'Child_Qty', 'Child_WH', 'Child_UOM', 'Child_TOR', 'BOMTYPE', 'HEIGHT', 'WIDTH', 'ACTIVE', 'MODIFIEDDATETIME'], 'required'],
            [['Parent_BomID', 'Parent_ItemID', 'Child_ItemID', 'Child_WH', 'Child_UOM', 'Child_TOR', 'Desc2'], 'string'],
            [['Child_Qty', 'HEIGHT', 'WIDTH'], 'number'],
            [['BOMTYPE', 'ACTIVE'], 'integer'],
            [['MODIFIEDDATETIME'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Parent_BomID' => 'Parent  Bom ID',
            'Parent_ItemID' => 'Parent  Item ID',
            'Child_ItemID' => 'Child  Item ID',
            'Child_Qty' => 'Child  Qty',
            'Child_WH' => 'Child  Wh',
            'Child_UOM' => 'Child  Uom',
            'Child_TOR' => 'Child  Tor',
            'BOMTYPE' => 'Bomtype',
            'HEIGHT' => 'Height',
            'WIDTH' => 'Width',
            'ACTIVE' => 'Active',
            'MODIFIEDDATETIME' => 'Modifieddatetime',
            'Desc2' => 'Desc2',
        ];
    }
}
