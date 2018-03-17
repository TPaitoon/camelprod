<?php
/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ArrayDataProvider */

/* @var $searchModel PtbmplanningSearch */

use backend\models\PtbmplanningSearch;
use common\models\CheckStatusInfo;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;

//print Yii::$app->getTimeZone();
$this->title = "ใบสั่งจ่ายงาน";
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash("res");

$datear = [];
$itemar = [];
$o = \common\models\PTBMPlanning::findAll(["status" => 0]);
$c = 0;
foreach ($o as $item) {
    for ($i = 0; $i < count($o); $i++) {
        if (empty($datear) && empty($itemar)) {
            array_push($datear, $item->date);
            array_push($itemar, $item->itemid);
        } else {
            if (!in_array($item->date, $datear) && !in_array($item->itemid, $itemar)) {
                array_push($datear, $item->date);
                array_push($itemar, $item->itemid);
            }
        }
    }
}

for ($z = 0; $z < count($datear); $z++) {
    $base = \common\models\PTBMPlanning::find()->where(["itemid" => $itemar[$z], "date" =>$datear[$z]])->count();
    print $base;
}
print_r($datear);
print_r($itemar);
?>
<div class="ptbmplanning-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= $this->render("_search", ["model" => $searchModel]) ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                "dataProvider" => $dataProvider,
                "pager" => [
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                ],
                "options" => [
                    "id" => "grid"
                ],
                "rowOptions" => function ($model) {
                    return ["id" => ArrayHelper::getValue($model, "status")];
                },
                "columns" => [
                    [
                        "class" => "yii\grid\SerialColumn",
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:5%",
                        ],
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                    ],
                    [
                        "class" => "yii\grid\CheckboxColumn",
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:5%",
                        ],
                        "contentOptions" => function ($model) {
                            $id = ArrayHelper::getValue($model, "status");
                            if ($id !== 0) {
                                return ["class" => "text-center", "style" => "visibility: hidden"];
                            } else {
                                return ["class" => "text-center"];
                            }
                        }
                    ],
//                    "id:raw:id",
                    [
                        "attribute" => "wrno",
                        "format" => "raw",
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:15%"
                        ],
                        "label" => "เลขที่"
                    ],
                    [
                        "attribute" => "date",
                        "format" => "datetime",
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:15%"
                        ],
                        "label" => "วันที่"
                    ],
                    [
                        "attribute" => "itemid",
                        "format" => "raw",
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:15%"
                        ],
                        "label" => "รหัสวัตถุดิบ"
                    ],
                    [
                        "attribute" => "qty",
                        "format" => "raw",
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:15%"
                        ],
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                        "label" => "จำนวน"
                    ],
                    [
                        "attribute" => "status",
                        "format" => "raw",
                        'headerOptions' => [
                            'style' => 'width:10%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center status'
                        ],
                        "value" => function ($model) {
                            $id = ArrayHelper::getValue($model, "status");
                            if ($id === 1) {
                                $dis = "label label-primary";
                            } else {
                                $dis = "label label-warning";
                            }
                            $obj = CheckStatusInfo::findOne(["statusid" => $id]);
                            return '<label class="' . $dis . '">' . $obj->name . '</label>';
                        },
                        "label" => "สถานะ"
                    ],
                    [
                        "class" => "yii\grid\ActionColumn",
                        "headerOptions" => [
                            "class" => "text-center",
                            "style" => "width:10%"
                        ],
                        "contentOptions" => [
                            "class" => "text-center"
                        ],
                        "template" => "{update}{delete}",
                        "buttons" => [
                            "update" => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', [
                                    "class" => "bupdate",
                                    "data-url" => $url
                                ]);
                            },
                            "delete" => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', ["data-url" => $url]);
                            }
                        ],
                        "urlCreator" => function ($action, $model) {
                            return "?r=ptbmplanning/" . $action . "&id=" . ArrayHelper::getValue($model, "id");
                        }
                    ],
                ],
            ]) ?>
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

Modal::begin([
    "id" => "update-modal",
    "size" => "modal-lg",
    "header" => "<h4>แก้ไขข้อมูล</h4>"
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
$(document).on("click",".bupdate",function() {
    // e.preventDefault();
    // alert($(this).attr("data-url"));
    var cmodal = $("#update-modal");
    if (cmodal.hasClass("in")) {
        cmodal.find(".modalContent").load($(this).attr("data-url"));
    } else {
        cmodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("data-url"));
    }
});

function checkDel(e) {
    if (confirm("ต้องการลบข้อมูล ?")) {
        $.ajax({
            type: "post",
            url: e.parent().attr("data-url"),
            async: false,
            cache: false
        });
    }
}

var txt = "$res";
if (txt !== "") { alert(txt); }
JS;
$this->registerJs($modeljs, static::POS_END);
?>
