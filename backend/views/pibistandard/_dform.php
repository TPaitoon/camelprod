<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 14/07/2018
 * Time: 14:56
 */

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandardDetail */
/* @var $form yii\widgets\ActiveForm */

$mlist = \common\models\PIBIStandard::find()->all();
$mhour = [];
for ($i = 8; $i <= 12; $i++) {
    array_push($mhour, ['ID' => $i, 'DHOUR' => $i]);
}
?>
    <div class="pibistandarddetail-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'refid')->widget(Select2::className(), [
                    'data' => ArrayHelper::map($mlist, 'refid', 'name'),
                    'options' => [
                        'placeholder' => 'เลือกมาตรฐาน',
                        'id' => 'drefid'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])->label('Standard') ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'hour')->dropDownList(ArrayHelper::map($mhour, 'ID', 'DHOUR'), ['id' => 'dhour'])->label('Hour') ?>
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
        <?php ActiveForm::end() ?>
    </div>
<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/chkkeypressnumber.js?Ver=0001', ['depends' => \yii\web\JqueryAsset::className()]);
?>