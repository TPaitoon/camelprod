<?php

namespace backend\controllers;

use Yii;
use common\models\PIBIBCEmplist;
use backend\models\PibibcemplistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibibcemplistController implements the CRUD actions for PIBIBCEmplist model.
 */
class PibibcemplistController extends Controller
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
     * Lists all PIBIBCEmplist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PibibcemplistSearch();
        $dataProvider1 = $searchModel->searchg1();
        $dataProvider2 = $searchModel->searchg2();

        return $this->render('index', [
            'dataProviderg1' => $dataProvider1,
            'dataProviderg2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single PIBIBCEmplist model.
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
     * Creates a new PIBIBCEmplist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PIBIBCEmplist();

        if ($model->load(Yii::$app->request->post())) {
            if ($this->findModelAll($model->shift, $model->group) !== null) {
                PIBIBCEmplist::deleteAll(["shift" => $model->shift, "group" => $model->group]);
            }
            $req = Yii::$app->request;
            $emplist = $req->post("empids");
            for ($i = 0; $i < count($emplist); $i++) {
                $new = new PIBIBCEmplist();
                $new->group = $model->group;
                $new->shift = $model->shift;
                $new->empid = $emplist[$i];
                $new->save(false);
            }
            return $this->redirect(["index"]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PIBIBCEmplist model.
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
     * Deletes an existing PIBIBCEmplist model.
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
     * Finds the PIBIBCEmplist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PIBIBCEmplist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PIBIBCEmplist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function findModelAll($shift, $group)
    {
        if (($model = PIBIBCEmplist::findAll(["shift" => $shift, "group" => $group])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
