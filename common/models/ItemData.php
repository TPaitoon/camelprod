<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRM_ItemData".
 *
 * @property string $ITEMID
 * @property string $DESCRIPTION
 * @property string $ITEMGROUPID
 * @property string $ITEMBUYERGROUPID
 * @property string $COSTGROUPID
 * @property string $BOMCALCGROUPID
 * @property string $REQGROUPID
 * @property string $PRIMARYVENDORID
 * @property integer $PRODFLUSHINGPRINCIP
 * @property integer $PDSSHELFLIFE
 * @property integer $PDSVENDORCHECKITEM
 * @property string $STORAGE
 * @property string $TRACKING
 * @property string $MODELGROUPID
 * @property string $PRICE
 * @property string $VENDORCHECK
 * @property string $FLUSHING
 * @property string $TAXITEMGROUPID
 * @property string $INVENTUNIT
 * @property string $PURCHUNIT
 * @property string $SALEUNIT
 * @property string $BOMUNITID
 * @property string $PACKAGINGGROUPID
 * @property string $TARAWEIGHT
 * @property string $NETWEIGHT
 * @property string $PROPERTYID
 * @property string $RECID
 */
class ItemData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRM_ItemData';
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
            [['ITEMID', 'DESCRIPTION', 'ITEMBUYERGROUPID', 'COSTGROUPID', 'BOMCALCGROUPID', 'REQGROUPID', 'PRIMARYVENDORID', 'PRODFLUSHINGPRINCIP', 'PDSSHELFLIFE', 'PDSVENDORCHECKITEM', 'PRICE', 'VENDORCHECK', 'FLUSHING', 'TAXITEMGROUPID', 'INVENTUNIT', 'PURCHUNIT', 'SALEUNIT', 'BOMUNITID', 'PACKAGINGGROUPID', 'TARAWEIGHT', 'NETWEIGHT', 'PROPERTYID', 'RECID'], 'required'],
            [['ITEMID', 'DESCRIPTION', 'ITEMGROUPID', 'ITEMBUYERGROUPID', 'COSTGROUPID', 'BOMCALCGROUPID', 'REQGROUPID', 'PRIMARYVENDORID', 'STORAGE', 'TRACKING', 'MODELGROUPID', 'VENDORCHECK', 'FLUSHING', 'TAXITEMGROUPID', 'INVENTUNIT', 'PURCHUNIT', 'SALEUNIT', 'BOMUNITID', 'PACKAGINGGROUPID', 'PROPERTYID'], 'string'],
            [['PRODFLUSHINGPRINCIP', 'PDSSHELFLIFE', 'PDSVENDORCHECKITEM', 'RECID'], 'integer'],
            [['PRICE', 'TARAWEIGHT', 'NETWEIGHT'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEMID' => 'Itemid',
            'DESCRIPTION' => 'Description',
            'ITEMGROUPID' => 'Itemgroupid',
            'ITEMBUYERGROUPID' => 'Itembuyergroupid',
            'COSTGROUPID' => 'Costgroupid',
            'BOMCALCGROUPID' => 'Bomcalcgroupid',
            'REQGROUPID' => 'Reqgroupid',
            'PRIMARYVENDORID' => 'Primaryvendorid',
            'PRODFLUSHINGPRINCIP' => 'Prodflushingprincip',
            'PDSSHELFLIFE' => 'Pdsshelflife',
            'PDSVENDORCHECKITEM' => 'Pdsvendorcheckitem',
            'STORAGE' => 'Storage',
            'TRACKING' => 'Tracking',
            'MODELGROUPID' => 'Modelgroupid',
            'PRICE' => 'Price',
            'VENDORCHECK' => 'Vendorcheck',
            'FLUSHING' => 'Flushing',
            'TAXITEMGROUPID' => 'Taxitemgroupid',
            'INVENTUNIT' => 'Inventunit',
            'PURCHUNIT' => 'Purchunit',
            'SALEUNIT' => 'Saleunit',
            'BOMUNITID' => 'Bomunitid',
            'PACKAGINGGROUPID' => 'Packaginggroupid',
            'TARAWEIGHT' => 'Taraweight',
            'NETWEIGHT' => 'Netweight',
            'PROPERTYID' => 'Propertyid',
            'RECID' => 'Recid',
        ];
    }
}
