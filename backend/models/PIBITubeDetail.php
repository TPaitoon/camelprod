<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 11:20
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class PIBITubeDetail extends \common\models\PIBITubeDetail
{
//    public $amount;
    public $losttube1, $losttube2, $car;
    public $listprice1, $listprice2, $listprice3;
    public $listid, $recid, $itemlist;

//    public $dummy1, $dummy2, $dummy3;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['losttube1', 'losttube2', 'car'], 'integer'],
            [['listprice1'], 'number'],
            [['listprice2', 'listprice3'], 'integer'],
            [['listid', 'recid', 'itemlist'], 'string'],
//            [['dummy1', 'dummy2', 'dummy3'], 'double'],
        ]);
    }
}