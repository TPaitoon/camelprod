<?php

/* @var $this yii\web\View */

use common\models\PIBIMCStandardMaster;
use kartik\form\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;

/* @var $model common\models\PIBIMCStandardDetail */
/* @var $form yii\widgets\ActiveForm */

$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/chkkeypressnumber.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$_tempmaster = PIBIMCStandardMaster::find()->all();
?>

<div class="pibimcstandard-form">
    <?php $form = ActiveForm::begin(['id' => 'pibimcform', 'type' => ActiveForm::TYPE_VERTICAL]); ?>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'refid')
                ->dropDownList(ArrayHelper::map($_tempmaster, 'refid', 'name'), ['disabled' => $model->isNewRecord ? false : true])
                ->label('มาตรฐาน')
            ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'hour')
                ->textInput(['id' => 'hour', 'autocomplete' => 'off', 'onkeypress' => 'return chknumber(event);'])
                ->label('ชั่วโมง')
            ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'amount')
                ->textInput(['id' => 'amount', 'autocomplete' => 'off', 'onkeypress' => 'return chknumber(event);'])
                ->label('เป้าหมาย')
            ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'rate')
                ->textInput(['id' => 'rate', 'autocomplete' => 'off', 'onkeypress' => 'return chknumber(event);'])
                ->label('ค่าพิเศษ')
            ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'extrasubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <div class="pull-right">
                <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>