<?php

use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIBCEmplist */
/* @var $form yii\widgets\ActiveForm */
$shiftlist = ShiftList::find()->all();
$emplist = EmpInfo::findAll(["Dept" => "ฝ่ายผลิต", "Sec" => "ประกอบยางใน"]);
$grouplist = [];
for ($i = 1; $i <= 15; $i++) {
    array_push($grouplist, ['A' => $i]);
}
?>
    <div class="pibibcemplist-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <?= $form->field($model, "shift")
                        ->dropDownList(ArrayHelper::map($shiftlist, "id", "shiftname"), ["id" => "shift"])
                        ->label("เลือกกะ") ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, "group")
                        ->dropDownList(ArrayHelper::map($grouplist, "A", "A"))
                        ->label("กลุ่ม") ?>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5><b>เลือกชื่อพนักงาน</b></h5>
                            </div>
                            <div class="col-lg-11">
                                <?= Select2::widget([
                                    "name" => "empselect",
                                    "data" => ArrayHelper::map($emplist, "PRS_NO", function ($data) {
                                        return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                                    }),
                                    "options" => [
                                        "placeholder" => "เลือกพนักงาน",
                                        "id" => "emplistselect"
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-success addemp">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered listemp">
                            <thead>
                            <tr>
                                <th width="150">รหัสพนักงาน</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="empids[]" class="form-control empid" readonly>
                                </td>
                                <td>
                                    <input type="text" name="empnames[]" class="form-control empname" readonly>
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-danger" onclick="removegroupline($(this))">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-4">
                                <?= "จำนวนพนักงาน : " ?>
                            </div>
                            <div class="col-lg-1">
                                <label id="cline" style="color: #00a157">#</label>
                            </div>
                            <div class="col-lg-1">
                                <?= "คน" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <?= Html::submitButton("บันทึก", ["id" => "pibibcemplistsubmit", "class" => "btn btn-success"]) ?>
                </div>
                <div class="pull-right">
                    <?= Html::a("หน้าหลัก", ["index"], ["class" => "btn btn-info"]) ?>

                    <?= Html::a("ย้อนกลับ", Yii::$app->request->referrer, ["class" => "btn btn-danger"]) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css?Ver=0001", ["depends" => JqueryAsset::className()]);
$this->registerJsFile($baseurl . "/js/pibi/newline-emplist-bc.js?Ver=0001", ["depends" => JqueryAsset::className()]);
?>