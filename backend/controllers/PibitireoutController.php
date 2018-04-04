<?php

namespace backend\controllers;

use backend\models\UserDirect;
use common\models\EmpInfo;
use Yii;
use common\models\PIBITireOut;
use backend\models\PibitireoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibitireoutController implements the CRUD actions for PIBITireOut model.
 */
class PibitireoutController extends Controller
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
     * Lists all PIBITireOut models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPIBIMaster();

        $usr == 'ITIT' || $usr == 'PSPS' ? $role = 1 : $role = 0;

        $searchModel = new PibitireoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    /**
     * Displays a single PIBITireOut model.
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
     * Creates a new PIBITireOut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBITireOut();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 0;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PIBITireOut model.
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
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PIBITireOut model.
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
     * Finds the PIBITireOut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBITireOut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBITireOut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetempname($id)
    {
        if (!empty($id)) {
            $emp = EmpInfo::findOne(["PRS_NO" => $id]);
            if (!empty($emp)) {
                return $emp->EMP_NAME . ' ' . $emp->EMP_SURNME;
            } else {
                return "";
            }
        }
    }

    public function actionCountmodel()
    {
        $req = Yii::$app->request;
        $date = $req->post("date");
        $empid = $req->post("empid");
        if (!empty($date) && !empty($empid)) {
            $model = PIBITireOut::findAll(["empid" => $empid,"date" => $date]);
            return count($model);
        }
    }
}
