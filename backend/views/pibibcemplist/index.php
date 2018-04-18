<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibimcemplistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการพนักงาน.';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');

?>
    <div class="pibimcemplist-index">
        <div class="panel">
            <div class="panel panel-body">
                <?= Html::a("เพิ่มข้อมูล", ["create"], ["class" => "btn btn-success createmodal"]) ?>
            </div>
        </div>
        <div class="panel">
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderg1,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'width:5%',
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ]
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
                            'label' => '',
                            'value' => function ($model) {
                                $id = ArrayHelper::getValue($model, 'shift');
                                return $id == 1 ? '<label class="label label-primary">กลางวัน</label>' : '<label class="label label-warning">กลางคืน</label>';
                            }
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
                            'label' => 'กลุ่ม',
                            'value' => function ($model) {
                                $id = ArrayHelper::getValue($model, "group");
                                return '<label class="label label-primary">' . $id . '</label>';
                            }
                        ],
                        [
                            'attribute' => 'empid',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:75%',
                                'class' => 'text-left'
                            ],
                            'contentOptions' => [
                                'class' => 'text-left'
                            ],
                            'label' => 'พนักงาน'
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
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', [
                                        'data-url' => $url,
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $id = ArrayHelper::getValue($model, 'id');
                                $url = '?r=pibimcemplist/' . $action . '&id=' . $id;
                                return $url;
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
        <div class="panel">
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderg2,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'width:5%',
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ]
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
                            'label' => '',
                            'value' => function ($model) {
                                $id = ArrayHelper::getValue($model, 'shift');
                                return $id == 1 ? '<label class="label label-primary">กลางวัน</label>' : '<label class="label label-warning">กลางคืน</label>';
                            }
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
                            'label' => 'กลุ่ม',
                            'value' => function ($model) {
                                $id = ArrayHelper::getValue($model, "group");
                                return '<label class="label label-primary">' . $id . '</label>';
                            }
                        ],
                        [
                            'attribute' => 'empid',
                            'format' => 'raw',
                            'headerOptions' => [
                                'style' => 'width:75%',
                                'class' => 'text-left'
                            ],
                            'contentOptions' => [
                                'class' => 'text-left'
                            ],
                            'label' => 'พนักงาน'
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
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', [
                                        'data-url' => $url,
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $id = ArrayHelper::getValue($model, 'id');
                                $url = '?r=pibimcemplist/' . $action . '&id=' . $id;
                                return $url;
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
<?php
Modal::begin([
    "id" => "create-modal",
    "size" => "modal-lg",
    "header" => "<h4>เพิ่มข้อมูล</h4>",
]);
echo '<div class="modalContent"></div>';
Modal::end();

$js = <<<JS
var txt = "$res";
if(txt !== "") { alert(txt); }

function checkDel(e) {
    if (confirm("ต้องการลบข้อมูล ?")) {
        del(e);
    }
}

function del(e) {
    var link = e.parent().attr('data-url');
    $.ajax({
        type: 'post',
        url: link,
        async: false,
        cache: false
    })
}

$(document).on("click",".createmodal",function(e) {
    e.preventDefault();
    var cmodal = $("#create-modal");
    if (cmodal.hasClass("in")) {
        cmodal.find(".modalContent").load($(this).attr("data-url"));
    } else {
        cmodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("href"));
    }
});

$("#create-modal").on("hidden.bs.modal",function() {
    location.reload();  
});
JS;
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css?Ver=0001", ['depends' => JqueryAsset::className()]);
$this->registerJs($js, static::POS_END);
?>