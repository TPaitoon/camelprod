<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRP_PTBMPlanning".
 *
 * @property integer $id
 * @property integer $wrno
 * @property string $date
 * @property string $asset
 * @property string $group
 * @property integer $itemid
 * @property integer $child_itemid
 * @property string $desc
 * @property integer $assy_Frame
 * @property double $assy_Weight
 * @property integer $qty
 * @property integer $status
 * @property string $child_desc
 */
class PTBMPlanning extends \yii\db\ActiveRecord
{
    public $c_itemiddesc, $recid;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRP_PTBMPlanning';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wrno', 'itemid', 'child_itemid', 'assy_Frame', 'qty', 'status'], 'integer'],
            [['date'], 'safe'],
            [['asset', 'group', 'desc', 'child_desc', 'c_itemdesc', 'c_itemid', 'recid'], 'string'],
            [['assy_Weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wrno' => 'Wrno',
            'date' => 'Date',
            'asset' => 'Asset',
            'group' => 'Group',
            'itemid' => 'Itemid',
            'child_itemid' => 'Child Itemid',
            'desc' => 'Desc',
            'assy_Frame' => 'Assy  Frame',
            'assy_Weight' => 'Assy  Weight',
            'qty' => 'Qty',
            'status' => 'Status',
            'child_desc' => 'Child Desc',
        ];
    }
}
