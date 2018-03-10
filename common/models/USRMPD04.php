<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "USRM_PD_04".
 *
 * @property string $ITEMBUYERGROUPID
 * @property string $DESCRIPTION
 * @property string $PRODID
 * @property string $ITEMID
 * @property string $PRODSTATUS
 * @property string $REMAINSTATUS
 * @property string $DLVDATE
 * @property string $BOMID
 * @property string $QTYSCHED
 * @property string $REMAININVENTPHYSICAL
 * @property string $INVENTDIMID
 * @property string $INVENTLOCATIONID
 * @property string $WMSLOCATIONID
 * @property string $INVENTBATCHID
 * @property string $QTYGOOD
 * @property integer $ERRORCAUSE
 * @property string $QTYERROR
 * @property string $ENUMNAME
 * @property string $ENUMLABEL
 * @property string $NAME
 * @property string $INVENTSERIALID
 * @property string $SCHEDDATE
 * @property integer $BACKORDERSTATUS
 * @property string $PRODPOOLID
 * @property string $INVENTREFID
 * @property string $REQPLANIDSCHED
 * @property string $CREATEDBY
 * @property string $ROUTEID
 * @property string $Desc2
 * @property string $REQGROUPID
 */
class USRMPD04 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USRM_PD_04';
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
            [['ITEMBUYERGROUPID', 'DESCRIPTION', 'PRODID', 'ITEMID', 'PRODSTATUS', 'REMAINSTATUS', 'BOMID', 'INVENTDIMID', 'INVENTLOCATIONID', 'WMSLOCATIONID', 'INVENTBATCHID', 'ENUMNAME', 'ENUMLABEL', 'NAME', 'INVENTSERIALID', 'PRODPOOLID', 'INVENTREFID', 'REQPLANIDSCHED', 'CREATEDBY', 'ROUTEID', 'Desc2', 'REQGROUPID'], 'string'],
            [['PRODID', 'ITEMID', 'PRODSTATUS', 'REMAINSTATUS', 'DLVDATE', 'BOMID', 'QTYSCHED', 'REMAININVENTPHYSICAL', 'INVENTDIMID', 'SCHEDDATE', 'BACKORDERSTATUS', 'PRODPOOLID', 'INVENTREFID', 'REQPLANIDSCHED', 'CREATEDBY', 'ROUTEID'], 'required'],
            [['DLVDATE', 'SCHEDDATE'], 'safe'],
            [['QTYSCHED', 'REMAININVENTPHYSICAL', 'QTYGOOD', 'QTYERROR'], 'number'],
            [['ERRORCAUSE', 'BACKORDERSTATUS'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEMBUYERGROUPID' => 'Itembuyergroupid',
            'DESCRIPTION' => 'Description',
            'PRODID' => 'Prodid',
            'ITEMID' => 'Itemid',
            'PRODSTATUS' => 'Prodstatus',
            'REMAINSTATUS' => 'Remainstatus',
            'DLVDATE' => 'Dlvdate',
            'BOMID' => 'Bomid',
            'QTYSCHED' => 'Qtysched',
            'REMAININVENTPHYSICAL' => 'Remaininventphysical',
            'INVENTDIMID' => 'Inventdimid',
            'INVENTLOCATIONID' => 'Inventlocationid',
            'WMSLOCATIONID' => 'Wmslocationid',
            'INVENTBATCHID' => 'Inventbatchid',
            'QTYGOOD' => 'Qtygood',
            'ERRORCAUSE' => 'Errorcause',
            'QTYERROR' => 'Qtyerror',
            'ENUMNAME' => 'Enumname',
            'ENUMLABEL' => 'Enumlabel',
            'NAME' => 'Name',
            'INVENTSERIALID' => 'Inventserialid',
            'SCHEDDATE' => 'Scheddate',
            'BACKORDERSTATUS' => 'Backorderstatus',
            'PRODPOOLID' => 'Prodpoolid',
            'INVENTREFID' => 'Inventrefid',
            'REQPLANIDSCHED' => 'Reqplanidsched',
            'CREATEDBY' => 'Createdby',
            'ROUTEID' => 'Routeid',
            'Desc2' => 'Desc2',
            'REQGROUPID' => 'Reqgroupid',
        ];
    }
}
