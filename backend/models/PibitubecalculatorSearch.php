<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 03/02/2018
 * Time: 13:38
 */

namespace backend\models;

use common\models\PIBITubeMaster;
use yii\base\Model;

class PibitubecalculatorSearch extends PIBITubeMaster
{
    public $startdate, $enddate, $role;

    public function rules()
    {
        return [
            [['id', 'shift', 'group', 'status'], 'integer'],
            [['date', 'startdate', 'enddate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        
    }
}