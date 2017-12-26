<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ExtraInfo;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraInfo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/chkextradetails.js?Ver=0001',['depends' => JqueryAsset::className()]);
$modelextra = ExtraInfo::find()->select(['id', 'ExtraName'])->andFilterWhere(['like', 'extra_id', $model->extra_id])->all();
?>

<div class="extra-info-form">

    <?php $form = ActiveForm::begin(['id' => 'extraform', 'type' => ActiveForm::TYPE_VERTICAL]); ?>
    <div class="box-body">
        <div class="col-lg-2">
            <?= $form->field($model, 'extra_id')->dropDownList(ArrayHelper::map($modelextra, 'id', 'ExtraName'), ['disabled' => $model->isNewRecord ? false : true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'Valuemin')->textInput(['id' => 'cmin']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'valuemax')->textInput(['id' => 'cmax']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'Rate')->textInput(['id' => 'crate']) ?>
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-left">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'extrasubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <div class="pull-right">
            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
