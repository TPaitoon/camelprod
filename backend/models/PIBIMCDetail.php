<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 27/01/2018
 * Time: 09:47 AM
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class PIBIMCDetail extends \common\models\PIBIMCDetail
{
    public $amount;
    public $losttire1, $losttire2, $losttube;
    public $listprice1, $listprice2, $listprice3;
    public $listid, $recid;

//    public $dummy1, $dummy2, $dummy3;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['amount', 'losttire1', 'losttire2', 'losttube'], 'integer'],
            [['listprice2', 'listprice3'], 'integer'],
            [['listprice1'], 'number'],
            [['listid', 'recid'], 'string'],
//            [['dummy1', 'dummy2', 'dummy3'], 'double'],
        ]);
    }
}