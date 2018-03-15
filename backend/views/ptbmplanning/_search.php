<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 15/03/2018
 * Time: 14:08
 */

use common\models\ItemData;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * @var $model backend\models\PtbmplanningSearch
 */

$itemid = ItemData::find()->all();
?>
    <div class="ptbmplanning-search">
        <?php $form = ActiveForm::begin([
            "action" => ["index"],
            "method" => "get"
        ]); ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, "itemid")
                    ->widget(Select2::className(), [
                        "data" => ArrayHelper::map($itemid, "ITEMID", "ITEMID"),
                        "options" => ["placeholder" => "เลือกรหัส"],
                        "pluginOptions" => ["allowClear" => true]
                    ])->label("รหัสวัตถุดิบ") ?>
            </div>
            <div class="col-lg-2">
                <?php empty($model->startdate) ? $model->startdate = date("Y-m-d") : $model->startdate ?>
                <?= $form->field($model, "startdate")
                    ->widget(DatePicker::className(), [
                        "name" => "startdate",
                        "type" => DatePicker::TYPE_COMPONENT_APPEND,
                        "readonly" => true,
                        "layout" => "{picker}{input}",
                        "options" => ["id" => "startdate"],
                        "pluginOptions" => [
                            "todayHighlight" => true,
                            "autoclose" => true,
                            "format" => "yyyy-mm-dd"
                        ]
                    ])->label("วันที่เริ่มค้นหา") ?>
            </div>
            <div class="col-lg-2">
                <?php empty($model->enddate) ? $model->enddate = date("Y-m-d") : $model->enddate ?>
                <?= $form->field($model, "enddate")
                    ->widget(DatePicker::className(), [
                        "name" => "enddate",
                        "type" => DatePicker::TYPE_COMPONENT_APPEND,
                        "readonly" => true,
                        "layout" => "{picker}{input}",
                        "options" => ["id" => "enddate"],
                        "pluginOptions" => [
                            "todayHighlight" => true,
                            "autoclose" => true,
                            "format" => "yyyy-mm-dd"
                        ]
                    ])->label("วันที่สิ้นสุดค้นหา") ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'id' => 'SearchSubmit']) ?>
            <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success bcreate']) ?>
            <?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info pull-right']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
<?php
$js = <<<JS
    $('#SearchSubmit').click(function(e) {
        e.preventDefault();
        if ($("#startdate").val() > $("#enddate").val()) {
            alert('วันที่เริ่มต้องไม่มากกว่าวันที่สิ้นสุด');
        } else {
            $(this).submit();
        }
    })
JS;
$this->registerJs($js, static::POS_END);
?>