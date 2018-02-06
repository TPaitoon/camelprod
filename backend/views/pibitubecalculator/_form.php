<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 11:27
 */

use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBITubeDetail */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])
    ->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();
$shiftlist = ShiftList::find()->all();
$grouplist = [];
$carlist = [];

for ($i = 1; $i <= 15; $i++) {
    array_push($grouplist, ['A' => $i]);
}
for ($i = 0; $i <= 1; $i++) {
    $i == 0 ? $txt = 'ไม่หัก' : $txt = 'หัก';
    array_push($carlist, ['A' => $i, 'B' => $txt]);
}
?>

    <div class="pibitubecalculator-form">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-lg-5" id="select-form">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5><b>เลือกรายชื่อพนักงาน</b></h5>
                            </div>
                            <div class="col-lg-10">
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
                            <div class="col-lg-2" style="text-align: center">
                                <button type="button" class="btn btn-success addemp"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered listemp">
                            <thead>
                            <tr>
                                <th width="100">รหัสพนักงาน</th>
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
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5><b>กรอกข้อมูลยอดผลิตของแต่ละกลุ่ม</b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered listtube">
                            <thead>
                            <tr>
                                <th width="100">กลุ่ม</th>
                                <th>ยอดเตรียมจุ๊บ</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <?= Html::dropDownList('groupselect', null, ArrayHelper::map($grouplist, 'A', 'A'), ['id' => 'grouplistselect', 'class' => 'form-control']) ?>
                                </td>
                                <td>
                                    <input type="text" name="amount" class="form-control amount" value="0" onkeypress="return chknumber(event)" maxlength="5">
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-success adddetail"><i class="fa fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-4">
                                <?= "จำนวนกลุ่ม : " ?>
                            </div>
                            <div class="col-lg-2" style="text-align: right">
                                <label id="gline" class="greenright">#</label>
                            </div>
                            <div class="col-lg-1">
                                กลุ่ม
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <?= "ยอดผลิตรวม : " ?>
                            </div>
                            <div class="col-lg-2" style="text-align: right">
                                <label id="aline" class="greenright">#</label>
                            </div>
                            <div class="col-lg-1">
                                เส้น
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $form->field($model, 'shift')
                                    ->dropDownList(ArrayHelper::map($shiftlist, 'id', 'shiftname'), ['id' => 'shift'])
                                    ->label('เลือกกะ') ?>
                            </div>
                            <div class="col-lg-4">
                                <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
                                <?= $form->field($model, 'date')
                                    ->widget(DatePicker::className(), [
                                        'options' => ['id' => 'date'],
                                        'name' => 'datepick',
                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                        'layout' => '{picker}{input}',
                                        'readonly' => true,
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'autoclose' => true,
                                            'todayHighlight' => true
                                        ]
                                    ])
                                    ->label('วันที่') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $this->render('_miniform') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?php $model->losttire1 == '' ? $model->losttire1 = 0 : $model->losttire1 ?>
                                <?= $form->field($model, 'losttire1')
                                    ->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'losttire1', 'onkeypress' => 'return chknumber(event)', 'style' => 'text-align: right'])
                                    ->label('จุ๊บเสีย (ก่อนนึ่ง)') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->losttire1 == '' ? $model->losttire1 = 0 : $model->losttire1 ?>
                                <?= $form->field($model, 'dummy1')
                                    ->textInput(['maxlength' => 4, 'readonly' => 'true', 'style' => 'text-align: right', 'id' => 'dummy1', 'value' => '0.25'])
                                    ->label('หักเงิน : ตัว') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->listprice1 == '' ? $model->listprice1 = 0 : $model->listprice1 ?>
                                <?= $form->field($model, 'listprice1')
                                    ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice1'])
                                    ->label('คิดเป็นเงิน : บาท') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?php $model->losttire2 == '' ? $model->losttire2 = 0 : $model->losttire2 ?>
                                <?= $form->field($model, 'losttire2')
                                    ->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'losttire2', 'onkeypress' => 'return chknumber(event)', 'style' => 'text-align: right'])
                                    ->label('จุ๊บเสีย (หลังนึ่ง)') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->losttire2 == '' ? $model->losttire2 = 0 : $model->losttire2 ?>
                                <?= $form->field($model, 'dummy2')
                                    ->textInput(['maxlength' => 4, 'readonly' => 'true', 'style' => 'text-align: right', 'id' => 'dummy2', 'value' => '5.00'])
                                    ->label('หักเงิน : ตัว') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->listprice2 == '' ? $model->listprice2 = 0 : $model->listprice2 ?>
                                <?= $form->field($model, 'listprice2')
                                    ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice2'])
                                    ->label('คิดเป็นเงิน : บาท') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?php $model->car == '' ? $model->car = 0 : $model->car ?>
                                <?= $form->field($model, 'car')
                                    ->dropDownList(ArrayHelper::map($carlist, 'A', 'B'),['id' => 'car'])
                                    ->label('หัก 5 ส.') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->losttire2 == '' ? $model->losttire2 = 0 : $model->losttire2 ?>
                                <?= $form->field($model, 'dummy3')
                                    ->textInput(['maxlength' => 4, 'readonly' => 'true', 'style' => 'text-align: right', 'id' => 'dummy3', 'value' => '100'])
                                    ->label('หักเงิน') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->listprice3 == '' ? $model->listprice3 = 0 : $model->listprice3 ?>
                                <?= $form->field($model, 'listprice2')
                                    ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice3'])
                                    ->label('คิดเป็นเงิน : บาท') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $form->field($model, 'xrate')
                                    ->textInput(['readonly' => true, 'value' => 0, 'style' => 'text-align: right', 'id' => 'xrate'])
                                    ->label('ค่าพิเศษ') ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'deduct')
                                    ->textInput(['readonly' => true, 'value' => 0, 'style' => 'text-align: right', 'id' => 'deduct'])
                                    ->label('หักเงินทั้งหมด') ?>
                            </div>
                            <div class="col-lg-3">
                                <?php $model->rate == '' ? $model->rate = 0 : $model->rate ?>
                                <?= $form->field($model, 'rate')
                                    ->textInput(['readonly' => true, 'style' => 'text-align: right', 'id' => 'rate'])
                                    ->label('ค่าพิเศษ : คน') ?>
                            </div>
                            <div class="col-lg-3">
                                <input hidden class="listid" name="listid[]" value="<?php echo $model->listid ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="pull-left">
                                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'pibisubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                <span hidden><?= Html::button('ตรวจสอบ', ['id' => 'checkinfo', 'class' => 'btn btn-info']) ?></span>
                            </div>
                            <div class="pull-right">
                                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                                <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCssFile($baseurl . '/css/pibitube/aligntext.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/chkkeypressnumber.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibitube/newline.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibitube/newtube.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibitube/calculator.js?Ver=0001', ['depends' => JqueryAsset::className()]);
?>