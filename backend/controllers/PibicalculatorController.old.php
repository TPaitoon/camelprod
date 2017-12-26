<?php

namespace backend\controllers;

use backend\models\CheckDebug;
use backend\models\UserDirect;
use common\models\PIBIDetail;
use common\models\PIBIMaster;
use common\models\PIBIStandard;
use common\models\PIBIStandardDetail;
use http\Exception\BadMessageException;
use Yii;
use backend\models\Pibicalculator;
use backend\models\PibicalculatorSearch;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibicalculatorController implements the CRUD actions for Pibicalculator model.
 */
class PibicalculatorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pibicalculator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForCPBicycletirei();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['PibicalculatorSearch']['startdate'])) {
            $searchModel = new PibicalculatorSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new PibicalculatorSearch();
            $dataProvider = $searchModel->showcreated();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single Pibicalculator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($date, $group, $shift)
    {
        //$temp = Pibicalculator::find()->where(['Date' => ])
        return $this->render('view', [
//            'model' => $this->findModel($id),
            'model' => ''
        ]);
    }

    /**
     * Creates a new Pibicalculator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pibicalculator();
        if ($model->load(Yii::$app->request->post())) {
//            return print_r(Yii::$app->request->post('empid'));
//            $debug = new CheckDebug();
//            return $debug->printr($model);
//            return print_r(Yii::$app->request->post('empids'));
//            return count($cnt);
//            throw new ErrorException('ไม่สามารถบันทึกข้อมูลได้ ...');
            try {
//                $debug = new CheckDebug();
//                return $debug->printr($model);
                $master = new PIBIMaster();
                $master->date = $model->Date;
                $master->group = $model->Groupid;
                $master->shift = $model->Shiftid;
                if ($master->save(false)) {
                    $empcnt = Yii::$app->request->post('empids');
                    for ($i = 0; $i < count($empcnt); $i++) {
                        for ($r = 1; $r <= 2; $r++) {
                            $pibidata = new Pibicalculator();
                            $pibidata->Groupid = $model->Groupid;
                            $pibidata->Shiftid = $model->Shiftid;
                            $pibidata->Empid = $empcnt[$i];
                            $pibidata->Date = $model->Date;
                            $pibidata->Hour = $model->Hour;
                            if ($r === 1) {
                                $pibidata->Typeid = $r;
                                $pibidata->Qty = $model->amount;
                            } elseif ($r === 2) {
                                $pibidata->Typeid = $r;
                                $pibidata->Qty = $model->rate;
                            }
                            $pibidata->Itemid = $model->Itemid;
                            $pibidata->Deduct = $model->Deduct;
                            $pibidata->Totaltire = $model->Totaltire;
                            $pibidata->Status = 0;
                            $pibidata->save(false);
                        }
                    }
                }
                //return $this->redirect(['view', 'id' => $model->id]);
                //return $this->redirect(['index']);
                return $this->actionIndex();
            } catch (Exception $exception) {
                throw new ErrorException('ไม่สามารถบันทึกข้อมูลได้ ...');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pibicalculator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pibicalculator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pibicalculator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pibicalculator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pibicalculator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetrate()
    {
        $app = Yii::$app->request;
        if (Yii::$app->request->isAjax) {
            $hour = $app->post('hour');
            $amount = $app->post('amount');
            $std = $app->post('std');

            if ($hour === '12') {
                $data = PIBIStandardDetail::find()->andWhere(['hour' => $hour, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                if (!empty($data)) {
                    //return Json::encode($data->rate);
                    $ex = ($amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    $data = PIBIStandardDetail::find()->andWhere(['hour' => 11, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                    if (!empty($data)) {
                        return Json::encode($data->rate);
                    } else {
                        return Json::encode(0);
                    }
                }
            } elseif ($hour === '11') {
                $data = PIBIStandardDetail::find()->andWhere(['hour' => $hour, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                if (!empty($data)) {
                    //return Json::encode($data->rate);
                    $ex = ($amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    $data = PIBIStandardDetail::find()->andWhere(['hour' => 10, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                    if (!empty($data)) {
                        return Json::encode($data->rate);
                    } else {
                        return Json::encode(0);
                    }
                }
            } elseif ($hour === '10') {
                $data = PIBIStandardDetail::find()->andWhere(['hour' => $hour, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                if (!empty($data)) {
                    //return Json::encode($data->rate);
                    $ex = ($amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    $data = PIBIStandardDetail::find()->andWhere(['hour' => 9, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                    if (!empty($data)) {
                        return Json::encode($data->rate);
                    } else {
                        return Json::encode(0);
                    }
                }
            } elseif ($hour === '9') {
                $data = PIBIStandardDetail::find()->andWhere(['hour' => $hour, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                if (!empty($data)) {
                    //return Json::encode($data->rate);
                    $ex = ($amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    $data = PIBIStandardDetail::find()->andWhere(['hour' => 8, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                    if (!empty($data)) {
                        return Json::encode($data->rate);
                    } else {
                        return Json::encode(0);
                    }
                }
            } elseif ($hour === '8') {
                $data = PIBIStandardDetail::find()->andWhere(['hour' => $hour, 'refid' => $std])->andFilterWhere(['<=', 'amount', $amount])->one();
                if (!empty($data)) {
                    //return Json::encode($data->rate);
                    $ex = ($amount - $data->amount) * 0.2917;
                    $cal = $data->rate + $ex;
                    return Json::encode(round($cal));
                } else {
                    return Json::encode(0);
                }
            }
            return Json::encode(array(0));
        }
    }
}
