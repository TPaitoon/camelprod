<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;

$this->title = 'ค่าพิเศษประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');
?>
    <input hidden class="role" value="<?php echo $role ?>">
    <div class="pibimccalculator-index">
        <div class="panel">
            <div class="panel panel-heading">
                <?php echo $this->render('_search', ['model' => $searchModel]) ?>
            </div>
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
                    'options' => [
                        'id' => 'grid'
                    ],
                    'rowOptions' => function ($model) {
                        return ['id' => ArrayHelper::getValue($model, 'status')];
                    },
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'width:5%'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ]
                        ],
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'width:5%'
                            ],
                            'contentOptions' => function ($model) {
                                $query = ArrayHelper::getValue($model, "status");
                                if ($query !== 0) {
                                    return ["class" => "text-center", "style" => "visibility: hidden"];
                                } else {
                                    return ["class" => "text-center"];
                                }
                            },
                            'checkboxOptions' => function ($model) {
                                $v = ArrayHelper::getValue($model, 'id') . ':';
                                return ['value' => $v];
                            }
                        ],
                        [
                            'attribute' => 'date',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:15%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'value' => function ($model) {
                                return '<i class="fa fa-calendar">' . ' ' . date('d/m/Y', strtotime(ArrayHelper::getValue($model, 'date')));
                            },
                            'label' => 'วันที่'
                        ],
                        [
                            'attribute' => 'group',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:10%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'label' => 'กลุ่ม'
                        ],
                        [
                            'attribute' => 'cnt',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:10%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'label' => 'จำนวณคน'
                        ],
                        [
                            'attribute' => 'hour',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:10%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'label' => 'ชั่วโมง'
                        ],
                        [
                            'attribute' => 'shift',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:10%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'value' => function ($model) {
                                $id = ArrayHelper::getValue($model, 'shift');
                                return $id == 1 ? '<label class="label label-primary">กลางวัน</label>' : '<label class="label label-warning">กลางคืน</label>';
                            },
                            'label' => 'ช่วงทำงาน'
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:10%',
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center status'
                            ],
                            'value' => function ($model) {
                                return ArrayHelper::getValue($model, 'status') == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                            },
                            'label' => 'สถานะ'
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'width:10%'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0)', [
                                        'id' => 'viewmodal',
                                        'data-url' => $url,
                                        'value' => ArrayHelper::getValue($model, "status") . ":" . ArrayHelper::getValue($model, "id"),
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    $st = ArrayHelper::getValue($model, 'status');
                                    $rl = ArrayHelper::getValue($model, 'role');

                                    if ($st == 0) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                    } elseif ($rl == 1) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                    } else {
                                        return '';
                                    }
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', [
                                        'data-url' => $url,
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $id = ArrayHelper::getValue($model, 'id');
                                $url = '?r=pibimccalculator/' . $action . '&id=' . $id;
                                return $url;
                            }
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
<?php
Modal::begin([
    "id" => "modal-view",
    "header" => "<h4>รายละเอียด</h4>",
    "size" => "modal-lg"
]);
echo "<div class='modalContent'></div>";
echo "<div class='modal-footer' style='text-align: center'>
        <button type='button' class='btn btn-success approved' style='width: 300px'>ยืนยันข้อมูล</button>
    </div>";
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibimc/script-mc.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$js = <<<JS
var txt = "$res";
if(txt !== "") { alert(txt); }

$(document).on("click","#viewmodal",function() {
    var x = $(this).attr("value");
    var str = x.split(":");
    
    var modalv = $("#modal-view");
    if (modalv.hasClass("in")) {
        modalv.find(".modalContent").load($(this).attr("data-url"));
        if (str[0] !== '0') {
            modalv.find(".modal-footer").hide();
        } else {
            modalv.find(".modal-footer").show();
            modalv.find(".approved").val(str[1]);
        }
    } else {
        modalv.modal("show").find(".modalContent").load($(this).attr("data-url"));
        if (str[0] !== '0') {
            modalv.find(".modal-footer").hide();
        } else {
            modalv.find(".modal-footer").show();
            modalv.find(".approved").val(str[1]);
        }
    }
});

$(".approved").on("click",function(e) {
    e.preventDefault();
    var data = $(this).attr("value");
    var rl = $(".role").val();
    
    if (rl !== "1") {
        alert("ไม่สามารถยืนยันได้เนื่องจากไม่มีสิทธิ์");
    } else {
        $.ajax({
            type: "post",
            url: "?r=pibimccalculator/setapproved",
            data: {id:data},
            dataType: "json",
            success: function(data) {
                if (data === 0) {
                    alert("บันทึกถูกยกเลิก");
                } else {
                    alert("บันทึกเรียบร้อยแล้ว");
                    location = "?r=pibimccalculator";
                }
            }
        });
    }
});
JS;

$this->registerJs($js, static::POS_END);
?>