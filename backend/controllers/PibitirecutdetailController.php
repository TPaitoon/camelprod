<?php

namespace backend\controllers;

use backend\models\UserDirect;
use Yii;
use common\models\PIBITIRECUTDETAIL;
use backend\models\PibitirecutdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibitirecutdetailController implements the CRUD actions for PIBITIRECUTDETAIL model.
 */
class PibitirecutdetailController extends Controller
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
     * Lists all PIBITIRECUTDETAIL models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();
        $usr == "IT" || $usr == "PS" ? $role = 1 : $role = 0;

        $req = Yii::$app->request;
        $searchModel = new PibitirecutdetailSearch();

        if ($req->isGet && isset($req->queryParams['PibitirecutdetailSearch']['startdate']))
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        else
            $dataProvider = $searchModel->searchcreated();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    /**
     * Displays a single PIBITIRECUTDETAIL model.
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
     * Creates a new PIBITIRECUTDETAIL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBITIRECUTDETAIL();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PIBITIRECUTDETAIL model.
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
     * Deletes an existing PIBITIRECUTDETAIL model.
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
     * Finds the PIBITIRECUTDETAIL model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBITIRECUTDETAIL the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBITIRECUTDETAIL::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
