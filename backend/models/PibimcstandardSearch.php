<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 24/01/2018
 * Time: 16:45 PM
 */

namespace backend\models;


use common\models\PIBIMCStandardDetail;
use common\models\PIBIMCStandardMaster;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * `common\models\PIBIMCStandardMaster`.
 */
class PibimcstandardSearch extends PIBIMCStandardMaster
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
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        /* Edit simple ExtrainfoSearch */
        $_tempmaster = PIBIMCStandardDetail::find()->orderBy(['refid' => 4])->all();
        $_temp = [];

        foreach ($_tempmaster as $i) {
            $_name = PIBIMCStandardMaster::find()->select(['name'])->where(['refid' => $i->refid])->one();

            array_push($_temp, [
                'id' => $i->id,
                'name' => $_name->name,
                'hour' => $i->hour,
                'amount' => $i->amount,
                'rate' => $i->rate
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $_temp,
            'sort' => [
                'attributes' => ['name', 'hour', 'amount', 'rate']
            ],
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        return $dataProvider;
    }
}