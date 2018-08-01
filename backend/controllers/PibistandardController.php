<?php

namespace backend\controllers;

use backend\models\UserDirect;
use common\models\PIBIStandardDetail;
use Yii;
use common\models\PIBIStandard;
use backend\models\PibistandardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibistandardController implements the CRUD actions for PIBIStandard model.
 */
class PibistandardController extends Controller
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
     * Lists all PIBIStandard models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $chk->ChkusrForAdmin();

        $searchModel = new PibistandardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PIBIStandard model.
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
     * Creates a new PIBIStandard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBIStandard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDcreate()
    {
        $model = new PIBIStandardDetail();
        return $this->render('dcreate', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing PIBIStandard model.
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
     * Deletes an existing PIBIStandard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreatemaster()
    {
        $Req = Yii::$app->request;
        $Name = $Req->post("namex");
        $Ref = $Req->post("refx");

        for ($i = 0; $i < count($Name); $i++) {
            $c = new PIBIStandard();
            $c->name = $Name[$i];
            $c->refid = $Ref[$i];
            $c->save();
        }

        return $this->redirect(['index']);
    }

    public function actionCreatedetail()
    {
        $model = new PIBIStandardDetail();


    }

    /**
     * Finds the PIBIStandard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBIStandard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBIStandard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
