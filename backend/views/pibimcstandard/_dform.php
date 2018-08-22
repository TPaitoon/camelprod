<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 10/08/2018
 * Time: 15:42
 */

use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \common\models\PIBIMCStandardDetail|\yii\db\ActiveRecord */

$mlist = \common\models\PIBIMCStandardMaster::find()->all();
$mhour = [];
for ($i = 8; $i <= 12; $i++) {
    array_push($mhour, ['ID' => $i, 'DHOUR' => $i]);
}
?>
    <div class="pibimcstandard-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'refid')->widget(\kartik\select2\Select2::className(), [
                    "data" => \yii\helpers\ArrayHelper::map($mlist, 'refid', 'name'),
                    "options" => [
                        "placeholder" => "เลือกมาตรฐาน",
                        "id" => "drefid"
                    ],
                    "pluginOptions" => [
                        "allowClear" => true,
                    ],
                ])->label("Standard") ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'hour')->dropDownList(\yii\helpers\ArrayHelper::map($mhour, 'ID', 'DHOUR'), ['id' => 'dhour'])->label('Hour') ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'amount')->textInput(['id' => 'damount', 'onkeypress' => 'return chknumber(event)'])->label('Amount') ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'rate')->textInput(['id' => 'drate', 'onkeypress' => 'return chknumber(event)'])->label('Rate') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success addlist"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/chkkeypressnumber.js?ver=0001', ['depends' => \yii\web\JqueryAsset::className()]);
?>