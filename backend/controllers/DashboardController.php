<?php

namespace backend\controllers;

use backend\models\Userinfo;
use common\models\ViewBicycle;
use Yii;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $usr = Userinfo::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (Yii::$app->request->isPost) {
            if ($usr->Dept == 'PSPS' || $usr->Dept == 'ITIT' || $usr->Dept == 'PTBT') {
            } else {
            }
        } else {
            // PTBT => Bicycle //
            $bicycleamountall = ViewBicycle::find()->where(['typeid' => 2])->sum('qty');
            $bicyclelosttimeall = ViewBicycle::find()->where(['typeid' => 1])->sum('qty');
            $bicycletotalamountall = ViewBicycle::find()->where(['typeid' => 2])->sum('minus');
        }

        return $this->render('index', [
            'bcamountall' => $bicycleamountall,
            'bclosttimeall' => $bicyclelosttimeall,
            'bctotalamountall' => $bicycletotalamountall,
        ]);
    }

}
