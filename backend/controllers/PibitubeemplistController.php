<?php

namespace backend\controllers;

use backend\models\Scripts;
use Yii;
use common\models\PIBITubeEmplist;
use backend\models\PibitubeemplistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibitubeemplistController implements the CRUD actions for PIBITubeEmplist model.
 */
class PibitubeemplistController extends Controller
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
     * Lists all PIBITubeEmplist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PibitubeemplistSearch();
        $dataProvider1 = $searchModel->searchg1();
        $dataProvider2 = $searchModel->searchg2();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single PIBITubeEmplist model.
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
     * Creates a new PIBITubeEmplist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBITubeEmplist();

        if ($model->load(Yii::$app->request->post())) {
            if ($this->findModelAll($model->shift) !== null) {
                PIBITubeEmplist::deleteAll(['shift' => $model->shift]);
            }
            $req = Yii::$app->request;
            $emplist = $req->post('empids');
            for ($i = 0; $i < count($emplist); $i++) {
                $create = new PIBITubeEmplist();
                $create->shift = $model->shift;
                $create->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
                $create->empid = $emplist[$i];
                $create->save(false);
            }

            return $this->redirect(['pibitubeemplist/index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PIBITubeEmplist model.
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
     * Deletes an existing PIBITubeEmplist model.
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
     * Finds the PIBITubeEmplist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBITubeEmplist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBITubeEmplist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function findModelAll($shift)
    {
        if (($model = PIBITubeEmplist::find()->where(['shift' => $shift])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function action_delete()
    {
        $req = Yii::$app->request;
        $shiftval = $req->post("shift");
        $count = count(PIBITubeEmplist::findAll(["shift" => $shiftval]));
        if ($count > 0) {
            PIBITubeEmplist::deleteAll(["shift" => $shiftval]);
            return "ลบข้อมูลเรียบร้อยแล้ว";
        } else {
            return "ไม่พบข้อมูล";
        }
    }
}
