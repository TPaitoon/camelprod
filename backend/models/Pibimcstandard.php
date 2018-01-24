<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 24/01/2018
 * Time: 16:45 PM
 */

namespace backend\models;


use common\models\PIBIMCStandardMaster;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * `common\models\PIBIMCStandardMaster`.
 */
class Pibimcstandard extends PIBIMCStandardMaster
{
    /**
     * @internal
     */
    public function rules()
    {
        return [
            [['id', 'refid'], 'integer'],
            [['name', 'string'], 'string'],
        ];
    }

    /**
     * @internal
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        /* Edit simple ExtrainfoSearch */
    }
}