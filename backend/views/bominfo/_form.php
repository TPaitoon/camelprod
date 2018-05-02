<?php

use backend\models\ExtraInfo;
use common\models\EmpInfo;
use common\models\HourInfo;
use common\models\StoveInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/calculatebom.js?Ver=0001', ['depends' => JqueryAsset::className()]);

$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'นึ่ง'])->all();
$hourarray = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();
$hourlist = [];
foreach ($hourarray as $item) {
    if ($item->values == '9') {
        continue;
    }
    if ($item->values == '11') {
        continue;
    }
    array_push($hourlist, [
        'hour' => $item->hour,
    ]);
}

//return print_r($hourlist);
//$debug = new \backend\models\CheckDebug();
//$debug->printr($data);return;
//print \yii\helpers\Url::previous();
?>

    <div class="bominfo-form">
        <div class="panel">
            <?php $form = ActiveForm::begin(['id' => 'bomform']); ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'empid')->widget(Select2::className(), [
                        'data' => ArrayHelper::map($empmodel, 'PRS_NO', function ($data) {
                            return $data->PRS_NO . " : " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                        }),
                        'options' => [
                            'placeholder' => 'เลือกพนักงาน',
                            'id' => 'cempid',
                        ],])->label('รหัสพนักงาน') ?>
                </div>
                <div class="col-md-3">
                    <?php $model->date == '' ? $model->date = date('d/m/Y') : $model->date ?>
                    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                        'options' => [
                            'id' => 'cdate'
                        ],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'layout' => '{picker}{input}',
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                    ])->label('วันที่ทำงาน') ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'stoveid')->dropDownList(ArrayHelper::map(StoveInfo::find()->all(), 'id', 'id'), ['id' => 'cstoveid'])->label('เตาที่') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'standard')->dropDownList(ArrayHelper::map(ExtraInfo::find()->all(), 'ExtraName', 'ExtraName'), ['id' => 'cstandard'])->label('มาตรฐาน') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'hour')->dropDownList(ArrayHelper::map($hourlist, 'hour', 'hour'), ['id' => 'chour'])->label('ชั่วโมง') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'amount')->textInput(['id' => 'camount', 'autocomplete' => 'off', 'onkeypress' => 'return chknumber(event)'])->label('ยอดนึ่ง') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'losttime')->textInput(['id' => 'closttime', 'autocomplete' => 'off', 'onkeypress' => 'return chknumber(event)'])->label('เสียเวลา : นาที') ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'deduct')->textInput([
                        'id' => 'cdeduct',
                        'autocomplete' => 'off',
                        'onkeypress' => 'return chknumber(event)'
                    ])->label('หักเงิน') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'totaltire')->textInput(['id' => 'ctotaltire', 'readonly' => true])->label('ยอดยาง') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'perpcs')->textInput(['id' => 'cperpcs', 'readonly' => true])->label('ราคา : เส้น') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'rate')->textInput(['id' => 'crate', 'readonly' => true])->label('ค่าพิเศษ') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'checkconfirm')->hiddenInput(['value' => 0])->label(false) ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div style="text-align: center">
                        <!--?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bomsubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
                        <?= Html::a('<i class="fa fa-plus"></i>', 'javascript:void(0)', ['class' => 'btn btn-success adddata', 'style' => 'width: 50px']) ?>
                        <!--?= Html::button('ค่าเริ่มต้น', ['id' => 'creset', 'class' => 'btn btn-danger']) ?-->
                    </div>
                </div>
            </div>
            <br>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="row">
            <div class="col-md-12">
                <h4>จำนวน : <label id="count" style="color: #00a65a">#</label> แถว</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="testf" action="index.php?r=bominfo/createmanual" method="post">
                        <div class="col-md-12">
                            <div style="overflow-x: scroll">
                                <table class="table table-bordered listemp">
                                    <thead>
                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>วันที่</th>
                                        <th>ชั่วโมง</th>
                                        <th>มาตรฐานเตา</th>
                                        <th>เตาที่</th>
                                        <th>ยอดนึ่ง</th>
                                        <th>เสียเวลา : นาที</th>
                                        <th>หักเงิน</th>
                                        <th>ยอดยาง</th>
                                        <th>ราคา : เส้น</th>
                                        <th>ค่าพิเศษ</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control empids" style="width: 100px"
                                                   name="empidx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control dates" style="width: 100px"
                                                   name="datex[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control hours" style="width: 100px"
                                                   name="hourx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control standards" style="width: 150px"
                                                   name="standardx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control stoveids" style="width: 100px"
                                                   name="stoveidx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control amounts" style="width: 100px"
                                                   name="amountx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control losttimes" style="width: 100px"
                                                   name="losttimex[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control deducts" style="width: 100px"
                                                   name="deductx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control totaltires" style="width: 100px"
                                                   name="totaltirex[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control perpcss" style="width: 100px"
                                                   name="perpcsx[]" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control rates" style="width: 100px"
                                                   name="ratex[]" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger"
                                                    onclick="removegroupline($(this))">
                                                <i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="pull-left">
                <button id="btnshowtable" class="btn btn-success">บันทึกข้อมูล</button>
            </div>
            <div class="pull-right">
                <?= Html::a('<i class="fa fa-home"></i>', ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('<i class="fa fa-undo"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/chkkeypressnumber.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCss('div.overflow {
width:100%;
overflow-x: scroll;
}');
?>