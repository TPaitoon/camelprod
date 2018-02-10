<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitubeemplistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$modaljs = <<<JS
$(".createmodal").on("click",function(e) {
    e.preventDefault();
    var link = $(this).attr("href");
     // alert(link);
     var modal = $("#modalcreate");
    modal.modal("show");
    modal.on("shown.bs.modal",function() {
      $(this).find("#modalContent").load(link);
    });
});
JS;
$this->registerJs($modaljs, static::POS_END);

$this->title = 'จัดการพนักงาน.';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pibitube-emplist-index">
        <div class="panel">
            <div class="panel panel-heading">
                <?= $this->render("_search", ['model' => $searchModel]) ?>
            </div>
            <div class="panel panel-body">
                /* For GridView */
            </div>
        </div>
    </div>
<?php
Modal::begin([
    'header' => '<h4>เพิ่มข้อมูล</h4>',
    'id' => 'modalcreate',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css?Ver=0001", ['depends' => JqueryAsset::className()]);
?>