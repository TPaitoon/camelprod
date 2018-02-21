<?php

namespace backend\controllers;

use Yii;
use common\models\PIBIMCEmplist;
use backend\models\PibimcemplistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibimcemplistController implements the CRUD actions for PIBIMCEmplist model.
 */
class PibimcemplistController extends Controller
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
     * Lists all PIBIMCEmplist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PibimcemplistSearch();
        $dataProviderg1 = $searchModel->searchg1();
        $dataProviderg2 = $searchModel->searchg2();

        return $this->render('index', [
            'dataProviderg1' => $dataProviderg1,
            'dataProviderg2' => $dataProviderg2,
        ]);
    }

    /**
     * Displays a single PIBIMCEmplist model.
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
     * Creates a new PIBIMCEmplist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBIMCEmplist();

        if ($model->load(Yii::$app->request->post())) {
            if ($this->findModelAll($model->shift, $model->group) !== null) {
                PIBIMCEmplist::deleteAll(["shift" => $model->shift, "group" => $model->group]);
            }
            $req = Yii::$app->request;
            $emplist = $req->post("empids");
            for ($i = 0; $i < count($emplist); $i++) {
                $create = new PIBIMCEmplist();
                $create->group = $model->group;
                $create->shift = $model->shift;
                $create->empid = $emplist[$i];
                $create->save(false);
            }
            return $this->redirect(["index"]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PIBIMCEmplist model.
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
     * Deletes an existing PIBIMCEmplist model.
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
     * Finds the PIBIMCEmplist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBIMCEmplist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBIMCEmplist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function findModelAll($shift, $group)
    {
        if (($model = PIBIMCEmplist::find()->where(["shift" => $shift, "group" => $group])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
