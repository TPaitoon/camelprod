<?php

namespace backend\models;

use common\models\PIBITIRECUTSTANDARD;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PIBITIRECUTDETAIL;
use yii\debug\models\timeline\DataProvider;

/**
 * PibitirecutdetailSearch represents the model behind the search form about `common\models\PIBITIRECUTDETAIL`.
 */
class PibitirecutdetailSearch extends PIBITIRECUTDETAIL
{
    public $startdate, $enddate, $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stdid'], 'integer'],
            [['empno', 'empname', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        empty($this->startdate) && empty($this->enddate) ? $this->startdate && $this->enddate = date("d/m/Y") : "";

        $this->load($params);
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $this->role = 1 : $this->role = 0;

        $obj = PIBITIRECUTDETAIL::find()->andFilterWhere(['like', 'empno', $this->empno])->andFilterWhere(['and', ['>=', 'date', Scripts::ConvertDateDMYtoYMDforSQL($this->startdate)], ['<=', 'date', Scripts::ConvertDateDMYtoYMDforSQL($this->enddate)]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $obj
        ]);

        return $dataProvider;
    }

    public function searchcreated()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == 'IT' || $usr == 'PS' ? $this->role = 1 : $this->role = 0;

        $query = PIBITIRECUTDETAIL::find()->where(['status' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $dataProvider;
    }
}
