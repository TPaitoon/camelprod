<?php

namespace backend\controllers;

use backend\models\CheckDebug;
use backend\models\UserDirect;
use backend\models\Userinfo;
use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use common\models\Standardsticker;
use common\models\StandardTireBicycleDetail;
use common\models\StandardTireBicycleInfo;
use Yii;
use backend\models\BicycletireInfo;
use backend\models\BicycletireinfoSearch;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * BicycletireinfoController implements the CRUD actions for BicycletireInfo model.
 */
class BicycletireinfoController extends Controller
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
     * Lists all BicycletireInfo models.
     * @return mixed
     */
    public function actionIndex()
    {

        $chk = new UserDirect();
        $usr = $chk->ChkusrForBicycletire();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['BicycletireinfoSearch']['startdate'])) {
            $searchModel = new BicycletireinfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new BicycletireinfoSearch();
            $dataProvider = $searchModel->showcreated();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single BicycletireInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($empid, $date)
    {
        $model = new BicycletireInfo();
        $bicycletirequery = BicycletireInfo::find()->where(['empid' => $empid, 'date' => $date])->all();
        $z = 0;
        foreach ($bicycletirequery as $i) {
            switch ($i->typeID) {
                case 1:
                    $model->losttime = $i->qty;
                    break;
                case 2:
                    $model->tireamount1 = $i->qty;
                    break;
                case 3:
                    $model->tireperpcs = $i->qty;
                    break;
                case 4:
                    $model->tirerate1 = $i->qty;
                    break;
                case 5:
                    $model->tireamount2 = $i->qty;
                    break;
                case 6:
                    $model->tirerate2 = $i->qty;
                    break;
                case 7:
                    $model->stickeramount = $i->qty;
                    break;
                case 8:
                    $model->stickerperpcs = $i->qty;
                    break;
                case 9:
                    $model->stickerrate = $i->qty;
                    break;
                case 10:
                    $model->deduct = $i->qty;
                    break;
                case 11:
                    $model->totalrate = $i->qty;
                    break;
            }
            $z++;
            if ($z == 11) {
                $model->empid = $i->empid;
                $model->empName = $i->empName;
                $model->date = $i->date;
                $model->hour = $i->hour;
                $model->standard = $i->standard;
                $model->totaltire = $i->totaltire;
                $model->stickername = $i->stickername;
                $model->checkconfirm = $i->checkconfirm;
                $z = 0;
            }
        }
        return $this->renderAjax('view', [
            //'model' => $this->findModel($id),
            'model' => $model
        ]);
    }

    /**
     * Creates a new BicycletireInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BicycletireInfo();

        if ($model->load(Yii::$app->request->post())) {
            $skn = Standardsticker::findOne($model->stickername);
            //$debug = new CheckDebug();
            //return $debug->printr($model,1);
            for ($i = 1; $i <= 11; $i++) {
                $create = new BicycletireInfo();
                switch ($i) {
                    case 1:
                        $create->typeID = $i;
                        $create->qty = $model->losttime;
                        break;
                    case 2:
                        $create->typeID = $i;
                        $create->qty = $model->tireamount1;
                        break;
                    case 3:
                        $create->typeID = $i;
                        $create->qty = $model->tireperpcs;
                        break;
                    case 4:
                        $create->typeID = $i;
                        $create->qty = $model->tirerate1;
                        break;
                    case 5:
                        $create->typeID = $i;
                        $create->qty = $model->tireamount2;
                        break;
                    case 6:
                        $create->typeID = $i;
                        $create->qty = $model->tirerate2;
                        break;
                    case 7:
                        $create->typeID = $i;
                        $create->qty = $model->stickeramount;
                        break;
                    case 8:
                        $create->typeID = $i;
                        $create->qty = $model->stickerperpcs;
                        break;
                    case 9:
                        $create->typeID = $i;
                        $create->qty = $model->stickerrate;
                        break;
                    case 10:
                        $create->typeID = $i;
                        $create->qty = $model->deduct;
                        break;
                    case 11:
                        $create->typeID = $i;
                        $create->qty = $model->totalrate;
                        break;
                }
                $create->empid = $model->empid;
                $create->empName = $model->empName;
                $create->date = $model->date;
                $create->standard = $model->standard;
                $create->hour = $model->hour . ' ชั่วโมง';
                $create->checkconfirm = 0;
                $create->stickername = $skn->stickername;
                $create->totaltire = $model->totaltire;
                $create->save(false);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BicycletireInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionUpdate($empid, $date)
    {
        //$model = $this->findModel($id);
        $model = new BicycletireInfo();
        $bicycletirequery = BicycletireInfo::find()->where(['empid' => $empid, 'date' => $date])->all();
        $z = 0;
        foreach ($bicycletirequery as $i) {
            switch ($i->typeID) {
                case 1:
                    $model->losttime = $i->qty;
                    break;
                case 2:
                    $model->tireamount1 = $i->qty;
                    break;
                case 3:
                    $model->tireperpcs = $i->qty;
                    break;
                case 4:
                    $model->tirerate1 = $i->qty;
                    break;
                case 5:
                    $model->tireamount2 = $i->qty;
                    break;
                case 6:
                    $model->tirerate2 = $i->qty;
                    break;
                case 7:
                    $model->stickeramount = $i->qty;
                    break;
                case 8:
                    $model->stickerperpcs = $i->qty;
                    break;
                case 9:
                    $model->stickerrate = $i->qty;
                    break;
                case 10:
                    $model->deduct = $i->qty;
                    break;
                case 11:
                    $model->totalrate = $i->qty;
                    break;
            }
            $z++;
            if ($z == 11) {
                $model->empid = $i->empid;
                $model->empName = $i->empName;
                $model->date = $i->date;
                $model->hour = $i->hour;
                $model->standard = $i->standard;
                $model->totaltire = $i->totaltire;
                $model->stickername = $i->stickername;
                $model->checkconfirm = $i->checkconfirm;
                $z = 0;
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tireid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BicycletireInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($empid, $date)
    {
        //$this->findModel($id)->delete();
        BicycletireInfo::deleteAll(['empid' => $empid, 'date' => $date]);
        Yii::$app->session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

        return $this->redirect(['index']);
    }

    /**
     * Finds the BicycletireInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BicycletireInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BicycletireInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShowempname($empid)
    {
        $model = EmpInfo::find()->where(['PRS_NO' => $empid])->one();
        if (!empty($model)) {
            return $model->EMP_NAME . ' ' . $model->EMP_SURNME;
        } else {
            return '';
        }
    }

    public function actionGetgroupcm()
    {
        if (Yii::$app->request->isAjax) {
            $standard = Yii::$app->request->post('standard');
            if (!empty($standard)) {
                $model = StandardTireBicycleInfo::find()->where(['standardname' => $standard])->one();
                //$ara = ['1', '2'];
                //return Json::encode($ara);
                //return $model->class . ',' . $model->min . ',' . $model->idexbicycle;
                return Json::encode(array($model->class, $model->min, $model->idexbicycle));
            }
        }
    }

    public function actionGetperpcsarate()
    {
        if (Yii::$app->request->isAjax) {
            $hour = Yii::$app->request->post('hour');
            $group = Yii::$app->request->post('group');
            $value = Yii::$app->request->post('value');
            $amount = Yii::$app->request->post('amount');
//            if (!empty($group) && !empty($value) && !empty($hour)) {
//                $model = StandardTireBicycleDetail::find()->where(['idexbicycle' => $group, 'valuemax' => null])->andWhere(['<=', 'valuemin', $value])->one();
//                if (!empty($model)) {
//                    $cal = $value * $model->rate;
//                    $rate = round($cal);
//                    return Json::encode(array($model->rate, $rate));
//                } elseif ($hour === '12') {
//                    if ($amount > 20) {
//                        return Json::encode(array(0, 47));
//                    } else {
//                        return Json::encode(array(0, 0));
//                    }
//                } else {
//                    $model = StandardTireBicycleDetail::find()->where(['idexbicycle' => $group])->andFilterWhere(['and', ['<=', 'valuemin', $value], ['>=', 'valuemax', $value]])->one();
//                    if (!empty($model)) {
//                        $cal = $value * $model->rate;
//                        $rate = round($cal);
//                        return Json::encode(array($model->rate, $rate));
//                    } else {
//                        if ($hour === '10') {
//                            if ($amount > 20) {
//                                return Json::encode(array(0, 40));
//                            } else {
//                                return Json::encode(array(0, 0));
//                            }
//                        } elseif ($hour === '8') {
//                            if ($amount > 20) {
//                                return Json::encode(array(0, 35));
//                            } else {
//                                return Json::encode(array(0, 0));
//                            }
//                        } else {
//                            return Json::encode(array(0, 0));
//                        }
//                    }
//                }
//            }

//            if (!empty($hour) && !empty($group) && !empty($value) && !empty($amount)) {
//                $model = StandardTireBicycleDetail::find()->where(['idexbicycle' => $group, 'hourwork' => $hour, 'valuemax' => null])->andWhere(['<=', 'valuemin', $value])->one();
//                if (!empty($model)) {
//                    $cal = $value * $model->rate;
//                    $rate = round($cal);
//                    return Json::encode(array($model->rate, $rate));
//                } else {
//                    $model = StandardTireBicycleDetail::find()->where(['idexbicycle' => $group, 'hourwork' => $hour])->andFilterWhere(['and', ['<=', 'valuemin', $value], ['>=', 'valuemax', $value]])->one();
//                    if (!empty($model)) {
//                        $cal = $value * $model->rate;
//                        $rate = round($cal);
//                        return Json::encode(array($model->rate, $rate));
//                    } else {
//                        if ($hour === '12' && $amount > 20) {
//                            return Json::encode(array(0, 47));
//                        } elseif ($hour === '10' && $amount > 20) {
//                            return Json::encode(array(0, 40));
//                        } elseif ($hour === '8') {
//                            return Json::encode(array(0, 35));
//                        } else {
//                            return Json::encode(array(0, 0));
//                        }
//                    }
//                }
//            }

            if ($hour === '12') {
                $data = StandardTireBicycleDetail::find()->andWhere(['valuemax' => null, 'hourwork' => $hour, 'idexbicycle' => $group])->andWhere(['<=', 'valuemin', $value])->one();
                if (!empty($data)) {
                    $cal = $value * $data->rate;
                    return Json::encode(array($data->rate, round($cal)));
                } elseif ($amount > 20) {
                    return Json::encode(array(0, 47));
                } else {
                    return Json::encode(array(0, 0));
                }
            } elseif ($hour === '10') {
                $data = StandardTireBicycleDetail::find()->andWhere(['hourwork' => $hour, 'idexbicycle' => $group])->andFilterWhere(['and', ['<=', 'valuemin', $value], ['>=', 'valuemax', $value]])->one();
                if (!empty($data)) {
                    $cal = $value * $data->rate;
                    return Json::encode(array($data->rate, round($cal)));
                } else {
                    $data = StandardTireBicycleDetail::find()->andWhere(['hourwork' => $hour, 'idexbicycle' => $group])->andWhere(['<=', 'valuemax', $value])->one();
                    if (!empty($data)) {
                        $cal = $value * $data->rate;
                        return Json::encode(array($data->rate, round($cal)));
                    } elseif ($amount > 20) {
                        return Json::encode(array(0, 40));
                    } else {
                        return Json::encode(array(0, 0));
                    }
                }
            } elseif ($hour === '8') {
                $data = StandardTireBicycleDetail::find()->andWhere(['hourwork' => $hour, 'idexbicycle' => $group])->andFilterWhere(['and', ['<=', 'valuemin', $value], ['>=', 'valuemax', $value]])->one();
                if (!empty($data)) {
                    $cal = $value * $data->rate;
                    return Json::encode(array($data->rate, round($cal)));
                } else {
                    $data = StandardTireBicycleDetail::find()->andWhere(['hourwork' => $hour, 'idexbicycle' => $group])->andWhere(['<=', 'valuemax', $value])->one();
                    if (!empty($data)) {
                        $cal = $value * $data->rate;
                        return Json::encode(array($data->rate, round($cal)));
                    } elseif ($amount > 20) {
                        return Json::encode(array(0, 35));
                    } else {
                        return Json::encode(array(0, 0));
                    }
                }
            }
        }
    }

    public function actionGetstickerrate()
    {
        if (Yii::$app->request->isAjax) {
            $stickerid = Yii::$app->request->post('stickerid');
            $model = Standardsticker::findOne($stickerid);
            if (!empty($model)) {
                return $model->stickerrate;
            } else {
                return 0;
            }
        }
    }

    public function actionGetcount()
    {
        if (Yii::$app->request->isAjax) {
            $empid = Yii::$app->request->post('empid');
            $date = Yii::$app->request->post('date');

            if (!empty($empid) && !empty($date)) {
                $model = BicycletireInfo::find()->where(['empid' => $empid, 'date' => $date])->count();
                return $model;
            }
        }
    }

    public function actionSetapproved()
    {
        $dataar = Yii::$app->request->post('dataar');
        $obj = Yii::$app->request->post('obj');
//        return $obj;
        if (!empty($dataar)) {
//            return $dataar;
            $id = [];
            $date = [];

            for ($i = 0; $i < count($dataar); $i++) {
                if ($dataar[$i] == 1) {
                    continue;
                } else {
                    $list = explode(',', $dataar[$i]);
                    array_push($id, $list[0]);
                    array_push($date, $list[1]);
                }
            }

            for ($x = 0; $x < count($id); $x++) {
                try {
                    BicycletireInfo::updateAll(['checkconfirm' => 1], ['empid' => $id[$x], 'date' => $date[$x]]);
                } catch (Exception $ex) {
                    return 0;
                }
            }
            return 1;
        } elseif (!empty($obj)) {
//            return $obj;
            $objexplode = explode("|", $obj);
            try {
                BicycletireInfo::updateAll(['checkconfirm' => 1], ['empid' => $objexplode[0], 'date' => $objexplode[1]]);
            } catch (\Exception $exception) {
                $session = Yii::$app->session;
                $session->setFlash('res', $exception);
                return 0;
            }
            return 1;
        } else {
            return 0;
        }
    }
}
