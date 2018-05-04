<?php

use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITubeEmplist */
/* @var $form yii\widgets\ActiveForm */
$shiftlist = ShiftList::find()->all();
$emplist = EmpInfo::findAll(['Dept' => 'ฝ่ายผลิต', 'Sec' => 'ประกอบยางใน']);
?>
    <div class="pibitubeemplist-form">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <?= $form->field($model, 'shift')->dropDownList(ArrayHelper::map($shiftlist, "id", "shiftname"), ["id" => "shift"])->label("เลือกกะ") ?>
                </div>
                <div class="col-lg-3">
                    <?php $model->date = date('d/m/Y') ?>
                    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                        'name' => 'date',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'layout' => '{picker}{input}',
                        'readonly' => true,
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ],
                        'options' => [
                            'id' => 'datepicker',
                        ]
                    ])->label('วันที่') ?>
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
                                <h5><b>เลือกรายชื่อพนักงาน</b></h5>
                            </div>
                            <div class="col-lg-11">
                                <?= Select2::widget([
                                    'name' => 'empselect',
                                    'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                                        return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                                    }),
                                    'options' => [
                                        'placeholder' => 'เลือกพนักงาน',
                                        'id' => 'emplistselect'
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
                                <?php echo "จำนวนพนักงาน : " ?>
                            </div>
                            <div class="col-lg-1">
                                <label id="cline" style="color: #00a157">#</label>
                            </div>
                            <div class="col-lg-1">
                                คน
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
                    <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'pibiemplistsubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <span hidden><?= Html::button('ตรวจสอบ', ['id' => 'checkinfo', 'class' => 'btn btn-info']) ?></span>
                </div>
                <div class="pull-right">
                    <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                    <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/pibitube/newline-emplist.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$js = <<<JS
$("#emplistselect").select2().on("select2:opening",function() {
    $("#create-modal").removeAttr("tabindex","-1");  
}).on("select2:close",function() {
    $("#create-modal").removeAttr("tabindex","1");    
});
JS;
$this->registerJs($js,static::POS_END);
?>