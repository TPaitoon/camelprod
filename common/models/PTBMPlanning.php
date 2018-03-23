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
 * @property string $itemid
 * @property integer $qty
 * @property integer $status
 */
class PTBMPlanning extends \yii\db\ActiveRecord
{
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
            [['wrno', 'qty', 'status'], 'integer'],
            [['date'], 'safe'],
            [['asset', 'group', 'itemid'], 'string'],
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
            'qty' => 'Qty',
            'status' => 'Status',
        ];
    }
}
