<?php

namespace backend\controllers;

use backend\models\PIBIDetail;
use backend\models\UserDirect;
use common\models\EmpInfo;
use common\models\PIBIMaster;
use common\models\PIBIStandardDetail;
use common\models\User;
use Yii;
use backend\models\PIBICalculator;
use backend\models\PibicalculatorSearch;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibicalculatorController implements the CRUD actions for PIBICalculator model.
 */
class PibicalculatorController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
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

    /**
     * Lists all PIBICalculator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['PibicalculatorSearch']['startdate'])) {
            $searchModel = new PibicalculatorSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new PibicalculatorSearch();
            $dataProvider = $searchModel->searchcreated();
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single PIBICalculator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $master = $this->findModel($id);

        $loop = PibiDetail::find()->where(['Shiftid' => $master->shift, 'Groupid' => $master->group, 'Date' => date('Y-m-d', strtotime($master->date)), 'refid' => $master->id])->all();
        $model = new PibiDetail();
        $c = 0;
        $recid = '';
        foreach ($loop as $i) {
            $i->Typeid == 1 ? $model->amount = $i->Qty : $model->amount = 0;
            $recid == '' ? $recid = $recid . $i->id : $recid = $recid . ',' . $i->id;
            if ($i->Typeid == 2) {
                $model->rate = $i->Qty;
                $c++;
                $c == 1 ? $model->listid = $i->Empid : $model->listid = $model->listid . ',' . $i->Empid;
                $model->Shiftid = $i->Shiftid;
                $model->Groupid = $i->Groupid;
                $model->Date = $i->Date;
                $model->Hour = $i->Hour;
                $model->Itemid = $i->Itemid;
                $model->Totaltire = $i->Totaltire;
                $model->Deduct = $i->Deduct;
            }
        }
        $model->recid = $master->id . ',' . $recid;

        return $this->render('view', ['model' => $model]);
    }

    /**
     * Creates a new PIBICalculator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBIDetail();

        if ($model->load(Yii::$app->request->post())) {
            try {
                $master = new PIBIMaster();
                $master->date = $model->Date;
                $master->group = $model->Groupid;
                $master->shift = $model->Shiftid;
                $master->status = 0;
                if ($master->save(false)) {
                    $empcnt = Yii::$app->request->post('empids');
                    for ($i = 0; $i < count($empcnt); $i++) {
                        for ($r = 1; $r <= 2; $r++) {
                            $pibidata = new PIBIDetail();
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
                            $pibidata->refid = $master->id;
                            $pibidata->save(false);
                        }
                    }
                }
//                return $this->actionIndex();
                return $this->redirect(['index']);
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
     * Updates an existing PIBICalculator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $master = $this->findModel($id);
//        return print_r($master);
        $loop = PibiDetail::find()->where(['Shiftid' => $master->shift, 'Groupid' => $master->group, 'Date' => date('Y-m-d', strtotime($master->date)), 'refid' => $master->id])->all();
        $model = new PibiDetail();
        $c = 0;
        $recid = '';
        foreach ($loop as $item) {
            if ($recid === '') {
                $recid = $recid . $item->id;
            } else {
                $recid = $recid . ',' . $item->id;
            }
            if ($item->Typeid == 1) {
                $model->amount = $item->Qty;
            }
            if ($item->Typeid == 2) {
                $model->rate = $item->Qty;
                $c++;
                $c == 1 ? $model->listid = $item->Empid : $model->listid = $model->listid . ',' . $item->Empid;
                $model->Shiftid = $item->Shiftid;
                $model->Groupid = $item->Groupid;
                $model->Date = $item->Date;
                $model->Hour = $item->Hour;
                $model->Itemid = $item->Itemid;
                $model->Totaltire = $item->Totaltire;
                $model->Deduct = $item->Deduct;
            }
        }
        $model->recid = $master->id . ',' . $recid;
        //return $model->recid;
        if ($model->load(Yii::$app->request->post())) {
            try {
                $loopdel = explode(',', $model->recid);
                for ($del = 0; $del < count($loopdel); $del++) {
                    if ($del === 0) {
                        PIBICalculator::deleteAll(['id' => $loopdel[$del]]);
                    } else {
                        PibiDetail::deleteAll(['id' => $loopdel[$del]]);
                    }
                }
                $master = new PIBIMaster();
                $master->date = $model->Date;
                $master->group = $model->Groupid;
                $master->shift = $model->Shiftid;
                $master->status = 0;
                if ($master->save(false)) {
                    $empcnt = Yii::$app->request->post('empids');
                    for ($i = 0; $i < count($empcnt); $i++) {
                        for ($r = 1; $r <= 2; $r++) {
                            $pibidata = new PIBIDetail();
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
                            $pibidata->refid = $master->id;
                            $pibidata->save(false);
                        }
                    }
                }
                return $this->actionIndex();
            } catch (Exception $exception) {
                throw new ErrorException('ไม่สามารถแก้ไขข้อมูลได้ ...');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PIBICalculator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $master = $this->findModel($id);
        if (!empty($master)) {
            PibiDetail::deleteAll(['Shiftid' => $master->shift, 'Groupid' => $master->group, 'Date' => date('Y-m-d', strtotime($master->date))]);
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the PIBICalculator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBICalculator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBICalculator::findOne($id)) !== null) {
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

    public function actionGetempname()
    {
        if (Yii::$app->request->isAjax) {
            $empid = Yii::$app->request->post('empid');
            if (!empty($empid)) {
                $list = explode(',', $empid);
                $array = [];
                for ($i = 0; $i < count($list); $i++) {
                    $data = EmpInfo::find()->select(['EMP_NAME', 'EMP_SURNME'])->where(['PRS_NO' => $list[$i]])->one();
                    if (!empty($data)) {
                        $name = $list[$i] . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                        array_push($array, $name);
                    }
                }
                return Json::encode($array);
            }
        }
    }

    public function actionSetapproved()
    {
        $dataar = Yii::$app->request->post('dataar');
        /*Editing*/
        if (!empty($dataar)) {

            array_splice($dataar, 0, 1);
            for ($i = 0; $i < count($dataar); $i++) {
                try {
                    PIBIMaster::updateAll(['status' => 1], ['id' => $dataar]);
                } catch (Exception $exception) {
                    return 0;
                }
            }

//            return Json::encode($dataar);
            return 1;
        } else {
            return 0;
        }
    }
}
