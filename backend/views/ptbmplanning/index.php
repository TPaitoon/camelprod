<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\web\JqueryAsset;

$this->title = "ใบสั่งจ่ายงาน";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ptbmplanning-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= Html::a("เพิ่มข้อมูล", ["create"], ["class" => "btn btn-success bcreate"]) ?>
        </div>
    </div>
</div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css?Ver=0001", ["depends" => JqueryAsset::className()]);

Modal::begin([
    "id" => "create-modal",
    "size" => "modal-lg",
    "header" => "<h4>เพิ่มข้อมูล</h4>"
]);
echo "<div class='modalContent'></div>";
Modal::end();

$modeljs = <<<JS
$(document).on("click",".bcreate",function(e) {
    e.preventDefault();
    var cmodal = $("#create-modal");
    if (cmodal.hasClass("in")) {
        cmodal.find(".modalContent").load($(this).attr("href"));
    } else {
        cmodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("href"));
    }
});
JS;
$this->registerJs($modeljs, static::POS_END);
?>
