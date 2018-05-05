<?php

namespace backend\controllers;

use backend\models\Scripts;
use backend\models\StandardBicycle;
use backend\models\UserDirect;
use backend\models\Userinfo;
use common\models\EmpInfo;
use Yii;
use backend\models\BicycleEmpInfo;
use backend\models\BicycleempinfoSearch;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BicycleempinfoController implements the CRUD actions for BicycleEmpInfo model.
 */
class BicycleempinfoController extends Controller
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
     * Lists all BicycleEmpInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPT();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['BicycleempinfoSearch']['startdate'])) {
            $searchModel = new BicycleempinfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new BicycleempinfoSearch();
            $dataProvider = $searchModel->showcreated();
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single BicycleEmpInfo model.
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
     * Creates a new BicycleEmpInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BicycleEmpInfo();
        $usr = Userinfo::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($usr->Dept === 'IT' || $usr->Dept === 'PS') {
            $chk = 1;
        } else {
            $chk = 0;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->empName = $this->Showempname($model->empid);
            $model->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
            $model->save();
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'chk' => $chk,
            ]);
        }
    }

    /**
     * Updates an existing BicycleEmpInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usr = Userinfo::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($usr->Dept === 'IT' || $usr->Dept === 'PS') {
            $chk = 1;
        } else {
            $chk = 0;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->empName = $this->Showempname($model->empid);
            $model->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
            $model->save();
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'chk' => $chk,
            ]);
        }
    }

    /**
     * Deletes an existing BicycleEmpInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

        return $this->redirect(['index']);
    }

    /**
     * Finds the BicycleEmpInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BicycleEmpInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BicycleEmpInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Showempname($id)
    {
        $model = EmpInfo::find()->where(['PRS_NO' => $id])->one();
        if (count($model) > 0) {
            return $model->EMP_NAME . ' ' . $model->EMP_SURNME;
        } else {
            return '';
        }
    }

    public function actionShowextra($id)
    {
        $model = StandardBicycle::find()->where(['Section' => $id])->one();
        if (count($model) > 0) {
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
                $model = BicycleEmpInfo::find()->where(['empid' => $empid, 'date' => $date])->all();
                return count($model);
            }
        }
    }

    public function actionSetapproved()
    {
        $dataar = Yii::$app->request->post('dataar');

        if (!empty($dataar)) {
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
                    BicycleEmpInfo::updateAll(['confirms' => 1], ['empid' => $id[$x], 'date' => $date[$x]]);
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
