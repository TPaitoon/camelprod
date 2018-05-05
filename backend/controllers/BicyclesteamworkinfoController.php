<?php

namespace backend\controllers;

use backend\models\Scripts;
use backend\models\UserDirect;
use backend\models\Userinfo;
use common\models\EmpInfo;
use common\models\SteambicycleworkInfo;
use Yii;
use backend\models\BicyclesteamworkInfo;
use backend\models\BicyclesteamworkinfoSearch;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BicyclesteamworkinfoController implements the CRUD actions for BicyclesteamworkInfo model.
 */
class BicyclesteamworkinfoController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all BicyclesteamworkInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPT();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['BicyclesteamworkinfoSearch']['startdate'])) {
            $searchModel = new BicyclesteamworkinfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new BicyclesteamworkinfoSearch();
            $dataProvider = $searchModel->showcreated();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single BicyclesteamworkInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BicyclesteamworkInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BicyclesteamworkInfo();

        if ($model->load(Yii::$app->request->post())) {
            $model->empName = $this->Showempname($model->empid);
            $model->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
            $model->save();
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BicyclesteamworkInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date = BicyclesteamworkinfoSearch::ConvertDate($model->date);
            $model->save();
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BicyclesteamworkInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('res','ลบข้อมูลเรียบร้อยแล้ว !');

        return $this->redirect(['index']);
    }

    /**
     * Finds the BicyclesteamworkInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BicyclesteamworkInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BicyclesteamworkInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Showempname($empid)
    {
        $model = EmpInfo::find()->where(['PRS_NO' => $empid])->one();
        if (!empty($model)) {
            return $model->EMP_NAME . ' ' . $model->EMP_SURNME;
        } else {
            return '';
        }
    }

    public function actionShowextra($id)
    {
        $model = SteambicycleworkInfo::find()->where(['section' => $id])->one();
        if (!empty($model)) {
            return $model->amount;
        } else {
            return 0;
        }
    }

    public function actionGetcount()
    {
        if (Yii::$app->request->isAjax) {
            $empid = Yii::$app->request->post('empid');
            $date = Yii::$app->request->post('date');

            if (!empty($empid) && !empty($date)) {
                $model = BicyclesteamworkInfo::find()->where(['empid' => $empid, 'date' => $date])->count();
                return $model;
            }
        }
    }

    public function actionSetapproved()
    {
        //print_r(Yii::$app->request->post('dataar'));
        //return;
        $dataar = Yii::$app->request->post('dataar');
//        print_r(count($dataar));
//        print_r($dataar);
//        return;

        if (!empty($dataar)) {
            /* สร้าง array ขึ้นมาเพื่อเก็บข้อมูล */
            $id = [];
            $date = [];

            /* ดึงค่าจาก dataar ที่ส่งมาจาก index โยนใส่ array ที่สร้างไว้ */
            for ($i = 0; $i < count($dataar); $i++) {
                if ($dataar[$i] == 1) {
                    continue;
                } else {
                    $list = explode(',', $dataar[$i]);
                    array_push($id, $list[0]);
                    array_push($date, $list[1]);
                }
            }
//            print_r($id);
//            print_r($date);
//            return;
            for ($x = 0; $x < count($id); $x++) {
                try {
                    BicyclesteamworkInfo::updateAll(['confirms' => 1], ['empid' => $id[$x], 'date' => $date[$x]]);
                } catch (Exception $ex) {
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
