<?php

namespace backend\controllers;

use backend\models\Scripts;
use backend\models\UserDirect;
use common\models\EmpInfo;
use common\models\ShiftList;
use Yii;
use common\models\PIBITireOut;
use backend\models\PibitireoutSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PibitireoutController implements the CRUD actions for PIBITireOut model.
 */
class PibitireoutController extends Controller
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
     * Lists all PIBITireOut models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPI();

        $usr == 'IT' || $usr == 'PS' ? $role = 1 : $role = 0;

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['PibitireoutSearch']['startdate'])) {
            $searchModel = new PibitireoutSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new PibitireoutSearch();
            $dataProvider = $searchModel->showcreated();
        }

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
            $model->empname = Scripts::ShowEmpname($model->empid);
            $model->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
            $model->status = 0;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'status' => 0
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

        if ($model->load(Yii::$app->request->post())) {
            $model->empname = Scripts::ShowEmpname($model->empid);
            $model->date = Scripts::ConvertDateDMYtoYMDforSQL($model->date);
            $model->save(false);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'status' => 1,
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
            $model = PIBITireOut::findAll(["empid" => $empid, "date" => $date]);
            return count($model);
        }
    }

    public function actionSetapproved()
    {
        $dataar = Yii::$app->request->post('dataar');

        if (!empty($dataar)) {
            for ($i = 0; $i < count($dataar); $i++) {
                if (strlen($dataar[$i]) == 1) {
                    continue;
                } else {
                    try {
                        $idexplode = explode(':', $dataar[$i]);
                        PIBITireOut::updateAll(['status' => 1], ['id' => $idexplode[0]]);
                    } catch (\Exception $exception) {
                        return 0;
                    }
                }
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function actionCreatemanual()
    {
        $Req = Yii::$app->request;
        $Empid = $Req->post("empidx");
        $Date = $Req->post("datex");
        $Shift = $Req->post("shiftx");
        $Rate = $Req->post("ratex");

        for ($i = 0; $i < count($Empid); $i++) {
            $Cnew = new PIBITireOut();
            $Cnew->empid = $Empid[$i];
            $Cnew->empname = Scripts::ShowEmpname($Empid[$i]);
            $Cnew->shift = $this->getShiftid($Shift[$i]);
            $Cnew->date = Scripts::ConvertDateDMYtoYMDforSQL($Date[$i]);
            $Cnew->qty = $Rate[$i];
            $Cnew->status = 0;
            $Cnew->save(false);
        }
        return Yii::$app->getResponse()->redirect(Url::previous());
    }

    private function getShiftid($name)
    {
        $_qurey = ShiftList::findOne(["shiftname" => $name]);
        return $_qurey->id;
    }

    public function actionLoopdelete()
    {
        $dataarray = Yii::$app->request->post("dataar");
        if (!empty($dataarray)) {
            for ($i = 0; $i < count($dataarray); $i++) {
                if (strlen($dataarray[$i]) == 1)
                    continue;
                else {
                    try {
                        $idexplode = explode(":",$dataarray[$i]);
                        PIBITireOut::deleteAll(["id" => $idexplode[0]]);
                    } catch (\Exception $exception) {
                        return 0;
                    }
                }
            }
            return 1;
        } else {
            return 0;
        }
    }
}
