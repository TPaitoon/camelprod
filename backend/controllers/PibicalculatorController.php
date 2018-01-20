<?php

namespace backend\controllers;

use backend\models\PIBIDetail;
use common\models\PIBIStandardDetail;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class PibicalculatorController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PIBIDetail();

        return $this->render('create', ['model' => $model]);
    }

    public function actionGetrate()
    {
        $app = Yii::$app->request;
        if ($app->isAjax) {
            $hour = $app->post('hour');
            $amount = $app->post('amount');
            $std = $app->post('std');

            if ($hour === '12') {
                $this->Calculator($amount, $hour, $std);
            } elseif ($hour === '11') {
                $this->Calculator($amount, $hour, $std);
            } elseif ($hour === '10') {
                $this->Calculator($amount, $hour, $std);
            } elseif ($hour === '9') {
                $this->Calculator($amount, $hour, $std);
            } elseif ($hour === '8') {
                $FindQuery = PIBIStandardDetail::find();
                $data = $FindQuery->andWhere(['hour' => $hour, 'refid' => $std])
                    ->andFilterWhere(['<=', 'amount', $amount])
                    ->one();
                if (!empty($data)) {
                    $ex = ((int)$amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    return Json::encode(0);
                }
            }
        }
    }

    public function Calculator($amount, $hour, $std)
    {
        $FindQuery = PIBIStandardDetail::find();
        $data = $FindQuery->andWhere(['hour' => $hour, 'refid' => $std])
            ->andFilterWhere(['<=', 'amount', $amount])
            ->one();
        if (!empty($data)) {
            $ex = ((int)$amount - $data->amount) * 0.2917;
            $cal = $data->rate + $ex;
            return Json::encode(round($cal));
        } else {
            $data = $FindQuery->andWhere(['hour' => $hour - 1, 'refid' => $std])
                ->andFilterWhere(['<=', 'amount', $amount])
                ->one();
            if (!empty($data)) {
                return Json::encode($data->rate);
            } else {
                return Json::encode(0);
            }
        }
    }
}
