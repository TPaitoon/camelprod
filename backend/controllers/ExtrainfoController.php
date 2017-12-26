<?php

namespace backend\controllers;

use backend\models\CheckDebug;
use backend\models\ExtraDetailInfo;
use backend\models\UserDirect;
use backend\models\Userinfo;
use Yii;
use backend\models\ExtraInfo;
use backend\models\ExtrainfoSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExtrainfoController implements the CRUD actions for ExtraInfo model.
 */
class ExtrainfoController extends Controller
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
     * Lists all ExtraInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $chk->ChkusrForAdmin();

        $searchModel = new ExtrainfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExtraInfo model.
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
     * Creates a new ExtraInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $debug = new CheckDebug();
        $model = new ExtraDetailInfo();

        if ($model->load(Yii::$app->request->post())) {
            $model->load(Yii::$app->request->post());
            $create = new ExtraDetailInfo();
            $create->extra_id = $model->extra_id;
            $create->Valuemin = $model->Valuemin;
            $create->valuemax = $model->valuemax;
            $create->Rate = $model->Rate;
            $create->save(false);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
//                'extradetail' => $extradetail,
            ]);
        }
    }

    /**
     * Updates an existing ExtraInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /*$debug = new CheckDebug();*/
        $model = ExtraDetailInfo::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            /* Update 11/07/2017 */
            /*$debug->printr($model);
            $debug->printr($extradetail);
            return;*/
            $update = ExtraDetailInfo::findOne($model->id);
            $update->extra_id = $model->extra_id;
            $update->Valuemin = $model->Valuemin;
            $update->valuemax = $model->valuemax;
            $update->Rate = $model->Rate;
            $update->save(false);

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
//                'extra' => $extra,
//                'extradetail' => $extradetail,
            ]);
        }
    }

    /**
     * Deletes an existing ExtraInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();*/
        ExtraDetailInfo::deleteAll(['id' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExtraInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExtraInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExtraDetailInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
//        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /* Update 12/07/2017 */
    /*function findModelExtra($name)
    {
        if (($extra = ExtraInfo::find()->where(['ExtraName' => $name])->one()) != null) {
            return $extra;
        } else {
            throw new NotAcceptableHttpException('The requested page does not exist.');
        }
    }

    function findModelExtradetail($rate)
    {
        if (($extradetail = ExtradetailInfo::find()->where(['Rate' => $rate])->one()) != null) {
            return $extradetail;
        } else {
            throw new NotAcceptableHttpException('The requested page does not exist.');
        }
    }*/
}
