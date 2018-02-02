<?php

namespace backend\controllers;

use backend\models\CheckDebug;
use backend\models\ExtraDetailInfo;
use backend\models\ExtraInfo;
use backend\models\ExtrainfoSearch;
use backend\models\UserDirect;
use backend\models\Userinfo;
use common\models\EmpInfo;
use Yii;
use backend\models\BOMInfo;
use backend\models\BominfoSearch;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BominfoController implements the CRUD actions for BOMInfo model.
 */
class BominfoController extends Controller
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
                    'delete' => ['POST'],
                    'update' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all BOMInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForBOM();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['BominfoSearch']['startdate'])) {
//            print Yii::$app->request->queryParams['BominfoSearch']['startdate'];
            $searchModel = new BominfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new BominfoSearch();
            $dataProvider = $searchModel->showcreated();
        }
//        $searchModel = new BominfoSearch();
//        $dataProvider = $searchModel->showcreated();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single BOMInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($empid,$date,$stoveid)
    {
        $extra = new ExtrainfoSearch();
        $bomquery = BOMInfo::find()->where(['empid' => $empid, 'stoveid' => $stoveid, 'date' => $date])->all();
        $losttime = '';
        $amount = '';
        $perpcs = '';
        $rate = '';
        $recid = '';
        $index = 0;
        foreach ($bomquery as $item) {
            switch ($item->typeID) {
                case 1:
                    $losttime = $item->qty;
                    $recid = $recid . $item->id;
                    break;
                case  2:
                    $amount = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
                case 3:
                    $perpcs = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
                case 4:
                    $rate = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
            }
            $index++;
            if ($index == 4) {
                $model = new BOMInfo();
                $model->empid = $item->empid;
                $model->empName = $item->empName;
                $model->date = $item->date;
                $model->stoveid = $item->stoveid;
                $model->standard = $item->standard;
                $model->hour = $item->hour;
                $model->amount = $amount;
                $model->losttime = $losttime;
                $model->totaltire = $item->totaltire;
                $model->perpcs = $perpcs;
                $model->rate = $rate;
                $model->deduct = $item->deduct;
                $model->listid = $recid;
            }
        }
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Creates a new BOMInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $usr = Userinfo::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($usr->Dept === 'ITIT' || $usr->Dept === 'PSPS') {
            $chk = 1;
        } else {
            $chk = 0;
        }
        $model = new BOMInfo();
        $extra = new ExtrainfoSearch();
        $data = $extra->getArray();

        if ($model->load(Yii::$app->request->post())) {
            //$debug = new CheckDebug();
            //$debug->printr($model,1);
            for ($i = 1; $i <= 4; $i++) {
                $create = new BOMInfo();
                $create->empid = $model->empid;
                $create->empName = $model->empName;
                if ($i === 1) {
                    $create->typeID = $i;
                    $create->qty = $model->losttime;
                } elseif ($i === 2) {
                    $create->typeID = $i;
                    $create->qty = $model->amount;
                } elseif ($i === 3) {
                    $create->typeID = $i;
                    $create->qty = $model->perpcs;
                } elseif ($i === 4) {
                    $create->typeID = $i;
                    $create->qty = $model->rate;
                }
                $create->date = $model->date;
                $create->stoveid = $model->stoveid;
                $create->standard = $model->standard;
                $create->hour = $model->hour;
                $create->checkconfirm = $chk;
                $create->deduct = $model->deduct;
                $create->totaltire = $model->totaltire;
                $create->save(false);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Updates an existing BOMInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($empid, $stoveid, $date)
    {
        //$model = $this->findModel($id);
        $extra = new ExtrainfoSearch();
        $data = $extra->getArray();
        $bomquery = BOMInfo::find()->where(['empid' => $empid, 'stoveid' => $stoveid, 'date' => $date])->all();
        $losttime = '';
        $amount = '';
        $perpcs = '';
        $rate = '';
        $recid = '';
        $index = 0;
        foreach ($bomquery as $item) {
            switch ($item->typeID) {
                case 1:
                    $losttime = $item->qty;
                    $recid = $recid . $item->id;
                    break;
                case  2:
                    $amount = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
                case 3:
                    $perpcs = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
                case 4:
                    $rate = $item->qty;
                    $recid = $recid . ',' . $item->id;
                    break;
            }
            $index++;
            if ($index == 4) {
                $model = new BOMInfo();
                $model->empid = $item->empid;
                $model->empName = $item->empName;
                $model->date = $item->date;
                $model->stoveid = $item->stoveid;
                $model->standard = $item->standard;
                $model->hour = $item->hour;
                $model->amount = $amount;
                $model->losttime = $losttime;
                $model->totaltire = $item->totaltire;
                $model->perpcs = $perpcs;
                $model->rate = $rate;
                $model->deduct = $item->deduct;
                $model->listid = $recid;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $recid = explode(',', $model->listid);
            if ($recid) {
                for ($i = 0; $i <= count($recid) - 1; $i++) {
                    $update = BOMInfo::find()->where(['id' => $recid[$i]])->one();
                    $update->empid = $model->empid;
                    $update->empName = $model->empName;
                    switch ($i + 1) {
                        case 1:
                            $update->typeID = 1;
                            $update->qty = $model->losttime;
                            break;
                        case 2:
                            $update->typeID = 2;
                            $update->qty = $model->amount;
                            break;
                        case 3:
                            $update->typeID = 3;
                            $update->qty = $model->perpcs;
                            break;
                        case 4:
                            $update->typeID = 4;
                            $update->qty = $model->rate;
                            break;
                    }
                    $update->date = $model->date;
                    $update->stoveid = $model->stoveid;
                    $update->standard = $model->standard;
                    $update->hour = $model->hour;
                    $update->deduct = $model->deduct;
                    $update->totaltire = $model->totaltire;
                    $update->save(false);
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'data' => $data
            ]);
        }
    }

    /**
     * Deletes an existing BOMInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($empid, $date, $stoveid)
    {
        //$this->findModel($id)->delete();
        BOMInfo::deleteAll(['empid' => $empid, 'date' => $date, 'stoveid' => $stoveid]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the BOMInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BOMInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BOMInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShowempname($id)
    {
        $model = EmpInfo::find()->where(['PRS_NO' => $id])->one();
        if (count($model) > 0) {
            return $model->EMP_NAME . ' ' . $model->EMP_SURNME;
        } else {
            return '';
        }
    }

    public function actionGetwork()
    {
        if (Yii::$app->request->isAjax) {
            $standard = Yii::$app->request->post('standard');
            $typeid = ExtraInfo::find()->select(['id'])->where(['ExtraName' => $standard])->one();
            if (!empty($typeid)) {
                $model = ExtraInfo::findOne($typeid);
                if (count($model) > 0) {
                    return $model->Values;
                } else {
                    return 0;
                }
            }
        }
    }

    public function actionGetcount()
    {
        if (Yii::$app->request->isAjax) {
            $empid = Yii::$app->request->post('empid');
            $date = Yii::$app->request->post('date');
            $stoveid = Yii::$app->request->post('stoveid');

            if (!empty($empid) && !empty($date) && !empty($stoveid)) {
                $model = BOMInfo::find()->where(['empid' => $empid, 'date' => $date, 'stoveid' => $stoveid])->count();
                return $model;
            }
        }
    }

    public function actionGetdata()
    {
        if (Yii::$app->request->isAjax) {
            $standard = Yii::$app->request->post('standard');
            $value = Yii::$app->request->post('value');
            $typeid = ExtraInfo::find()->select(['id'])->where(['ExtraName' => $standard])->one();
            if (!empty($typeid) && !empty($value)) {
                $model = ExtraDetailInfo::find()->where(['extra_id' => $typeid, 'valuemax' => null])->andWhere(['<=', 'Valuemin', $value])->one();
                if (count($model) > 0) {
                    return $model->Rate;
                } else {
                    $model = ExtraDetailInfo::find()->where(['extra_id' => $typeid])->andFilterWhere(['and', ['<=', 'Valuemin', $value], ['>=', 'valuemax', $value]])->one();
                    if (count($model) > 0) {
                        return $model->Rate;
                    } else {
                        return 0;
                    }
                }
            }
        }
    }

    public function actionSetapproved()
    {
        $dataar = Yii::$app->request->post('dataar');

//        print_r($dataar);return;

        if (!empty($dataar)) {
            $id = [];
            $date = [];
            $stove = [];

            for ($i = 0; $i < count($dataar); $i++) {
                if ($dataar[$i] == 1) {
                    continue;
                } else {
                    $list = explode(',', $dataar[$i]);
                    array_push($id, $list[0]);
                    array_push($date, $list[1]);
                    array_push($stove, $list[2]);
                }
            }

            for ($x = 0; $x < count($id); $x++) {
                try {
                    BOMInfo::updateAll(['checkconfirm' => 1], ['empid' => $id[$x], 'date' => $date[$x], 'stoveid' => $stove[$x]]);
                } catch (Exception $exception) {
                    return 0;
                    break;
                }
            }
            return 1;
        } else {
            return 0;
        }
    }
}
