<?php

namespace backend\controllers;

use backend\models\Scripts;
use backend\models\UserDirect;
use backend\models\Userinfo;
use common\models\EmpInfo;
use common\models\StandardbicycleEx;
use common\models\Weaverbicycle;
use Yii;
use backend\models\BicycleInfo;
use backend\models\BicycleinfoSearch;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BicycleinfoController implements the CRUD actions for BicycleInfo model.
 */
class BicycleinfoController extends Controller
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
     * Lists all BicycleInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $chk = new UserDirect();
        $usr = $chk->ChkusrForPT();

        if (Yii::$app->request->isGet && isset(Yii::$app->request->queryParams['BicycleinfoSearch']['startdate'])) {
            $searchModel = new BicycleinfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $searchModel = new BicycleinfoSearch();
            $dataProvider = $searchModel->showcreated();
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Role' => $usr,
        ]);
    }

    /**
     * Displays a single BicycleInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($empid, $date)
    {
        $bicyclequery = BicycleInfo::find()->where(['empid' => $empid, 'date' => $date])->all();
        $model = new BicycleInfo();
        $recid = '';
        $index = 0;
        foreach ($bicyclequery as $value) {
            switch ($value->typeid) {
                case 1:
                    $model->losttime = $value->qty;
                    $recid = $recid . $value->id;
                    break;
                case 2:
                    $model->amount = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
                case 3:
                    $model->perpcs = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
                case 4:
                    $model->rate = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
            }
            $index++;
            if ($index == 4) {
                $model->empid = $value->empid;
                $model->empname = $value->empname;
                $model->date = $value->date;
                $model->tirename = $value->tirename;
                $model->grouptire = $value->grouptire;
                $model->minus = $value->minus;
                $model->checks = $value->checks;
                $model->listid = $recid;
            }
        }
        return $this->renderAjax('view_2', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new BicycleInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BicycleInfo();
        if ($model->load(Yii::$app->request->post())) {
//            for ($i = 1; $i <= 4; $i++) {
//                $create = new BicycleInfo();
//                $create->empid = $model->empid;
//                $create->empname = $this->Showempname($model->empid);
//                $create->typeid = $i;
//                switch ($i) {
//                    case 1:
//                        $create->qty = $model->losttime;
//                        break;
//                    case 2:
//                        $create->qty = $model->amount;
//                        break;
//                    case 3:
//                        $create->qty = $model->perpcs;
//                        break;
//                    case 4:
//                        $create->qty = $model->rate;
//                        break;
//                }
//                $create->tirename = $model->tirename;
//                $create->date = self::ConvertDate($model->date);
//                $create->checks = $model->checks;
//                $create->minus = $model->minus;
//                $create->grouptire = $model->grouptire;
//                $create->save(false);
//            }
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BicycleInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($empid, $date)
    {
        $bicyclequery = BicycleInfo::find()->where(['empid' => $empid, 'date' => self::ConvertDate($date)])->all();
        $model = new BicycleInfo();
        $recid = '';
        $index = 0;
        foreach ($bicyclequery as $value) {
            switch ($value->typeid) {
                case 1:
                    $model->losttime = $value->qty;
                    $recid = $recid . $value->id;
                    break;
                case 2:
                    $model->amount = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
                case 3:
                    $model->perpcs = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
                case 4:
                    $model->rate = $value->qty;
                    $recid = $recid . ',' . $value->id;
                    break;
            }
            $index++;
            if ($index == 4) {
                $model->empid = $value->empid;
                $model->empname = $this->Showempname($value->empid);
                $model->date = $value->date;
                $model->tirename = $value->tirename;
                $model->grouptire = $value->grouptire;
                $model->minus = $value->minus;
                $model->checks = $value->checks;
                $model->listid = $recid;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $recid = explode(',', $model->listid);
            if ($recid) {
                for ($i = 0; $i <= count($recid) - 1; $i++) {
                    $update = BicycleInfo::findOne($recid[$i]);
                    $update->empid = $model->empid;
                    $update->empname = $this->Showempname($model->empid);
                    switch ($i + 1) {
                        case 1:
                            $update->typeid = 1;
                            $update->qty = $model->losttime;
                            break;
                        case 2:
                            $update->typeid = 2;
                            $update->qty = $model->amount;
                            break;
                        case 3:
                            $update->typeid = 3;
                            $update->qty = $model->perpcs;
                            break;
                        case 4:
                            $update->typeid = 4;
                            $update->qty = $model->rate;
                            break;
                    }
                    $update->tirename = $model->tirename;
                    $update->date = self::ConvertDate($model->date);
                    $update->checks = $model->checks;
                    $update->minus = $model->minus;
                    $update->grouptire = $model->grouptire;
                    $update->save(false);
                }
            }
//            return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BicycleInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($empid, $date)
    {
        BicycleInfo::deleteAll(['empid' => $empid, 'date' => $date]);
        Yii::$app->session->setFlash('res', 'ลบข้อมูลเรียบร้อยแล้ว !');

        return Yii::$app->getResponse()->redirect(Url::previous());
    }

    /**
     * Finds the BicycleInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BicycleInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BicycleInfo::findOne($id)) !== null) {
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

    public function actionShowgrouptire($name)
    {
        $model = Weaverbicycle::find()->where(['sizename' => $name])->one();
        if (!empty($model)) {
            $grouptire = StandardbicycleEx::find()->where(['groups' => $model->groups])->one();
            return $grouptire->average;
        } else {
            return 0;
        }
    }

    public function actionGetrate()
    {
        if (Yii::$app->request->isAjax) {
            $average = Yii::$app->request->Post('average');
            $value = Yii::$app->request->post('value');
            if (!empty($average) && !empty($value)) {
                $model = StandardbicycleEx::find()->where(['average' => $average, 'valueMax' => null])->andFilterWhere(['<=', 'valueMin', $value])->one();
                if (count($model) > 0) {
                    return $model->Rate;
                } else {
                    $model = StandardbicycleEx::find()->where(['average' => $average])->andFilterWhere(['and', ['<=', 'valueMin', $value], ['>=', 'valueMax', $value]])->one();
                    if (count($model) > 0) {
                        return $model->Rate;
                    } else {
                        return 0;
                    }
                }
            }
        }
    }

    public function actionGetcount()
    {
        if (Yii::$app->request->isAjax) {
            $empid = Yii::$app->request->post('empid');
            $date = Yii::$app->request->post('date');
            $model = BicycleInfo::find()->where(['empid' => $empid, 'date' => $date])->all();
            return count($model);
        }
    }

    public function actionSetapproved()
    {
        $daatar = Yii::$app->request->post('dataar');
        $obj = Yii::$app->request->post('obj');

        $id = [];
        $date = [];

        if (!empty($daatar)) {
            for ($i = 0; $i < count($daatar); $i++) {
                if ($daatar[$i] == 1) {
                    continue;
                } else {
                    $list = explode(',', $daatar[$i]);
                    array_push($id, $list[0]);
                    array_push($date, $list[1]);
                }
            }

            for ($x = 0; $x < count($id); $x++) {
                try {
                    BicycleInfo::updateAll(['checks' => 1], ['empid' => $id[$x], 'date' => $date[$x]]);
                } catch (Exception $ex) {
                    return 0;
                }
            }
            return 1;
        } elseif (!empty($obj)) {
            $objexplode = explode("|", $obj);
            try {
                BicycleInfo::updateAll(['checks' => 1], ['empid' => $objexplode[0], 'date' => $objexplode[1]]);
            } catch (\Exception $exception) {
                return 0;
            }
            return 1;
        } else {
            return 0;
        }
    }

    public static function ConvertDate($val)
    {
        $_temp = str_replace("/", "-", $val);
        return date('Y-m-d', strtotime($_temp));
    }

    public function actionCreatemanual()
    {
        $Req = Yii::$app->request;
        $Empid = $Req->post("empidx");
        $Date = $Req->post("datex");
        $Tirename = $Req->post("tirenamex");
        $Grouptire = $Req->post("grouptirex");
        $Amount = $Req->post("amountx");
        $Losttime = $Req->post("losttimex");
        $Minus = $Req->post("minusx");
        $Perpcs = $Req->post("perpcsx");
        $Rate = $Req->post("ratex");

        for ($i = 0; $i < count($Empid); $i++) {
            for ($x = 1; $x <= 4; $x++) {
                $cnew = new BicycleInfo();
                $cnew->empid = $Empid[$i];
                $cnew->empname =$this->Showempname($Empid[$i]);
                $x == 1 ? $cnew->qty = $Losttime[$i] : "";
                $x == 2 ? $cnew->qty = $Amount[$i] : "";
                $x == 3 ? $cnew->qty = $Perpcs[$i] : "";
                $x == 4 ? $cnew->qty = $Rate[$i] : "";
                $cnew->typeid = $x;
                $cnew->tirename = $Tirename[$i];
                $cnew->date = Scripts::ConvertDateDMYtoYMDforSQL($Date[$i]);
                $cnew->checks = 0;
                $cnew->minus = $Minus[$i];
                $cnew->grouptire = $Grouptire[$i];
                $cnew->save(false);
            }
        }
        return Yii::$app->getResponse()->redirect(Url::previous());
    }
}
