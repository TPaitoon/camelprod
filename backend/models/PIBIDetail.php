<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:11 AM
 */

namespace backend\models;


use yii\helpers\ArrayHelper;

class PIBIDetail extends \common\models\PIBIDetail
{
    public $amount;
    public $losttire1, $losttire2, $losttube;
    public $listprice1, $listprice2, $listprice3;
    public $listid;

//    public $dummy1, $dummy2, $dummy3;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['amount', 'losttire1', 'losttire2', 'losttube'], 'integer'],
            [['listprice2', 'listprice3'], 'integer'],
            [['listprice1'], 'double'],
            [['listid'], 'string'],
//            [['dummy1', 'dummy2', 'dummy3'], 'double'],
        ]);
    }
}