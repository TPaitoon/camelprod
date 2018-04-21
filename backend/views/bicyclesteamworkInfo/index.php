<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicyclesteamworkinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS

    function chkdelete(e) {
        if (confirm('ต้องการลบข้อมูล ?')) {
            if ($(".role").val() !== '1') {
                var status = e.closest('tr').attr('id');
                if (status !== '0') {
                    alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
                } else {
                    var link = e.parent().attr('data-url');
                    // alert(link);
                    $.ajax({
                        type: 'post',
                        url: link,
                        async: false,
                        cache: false,
                        success: function() {
                            alert('ลบเรียบร้อยแล้ว');
                            location.reload();
                        }
                    })
                }
            } else {
                var link = e.parent().attr('data-url');
                // alert(link);
                $.ajax({
                    type: 'post',
                    url: link,
                    async: false,
                    cache: false,
                    success: function() {
                        alert('ลบเรียบร้อยแล้ว');
                        location.reload();
                    }
                })
            }
        }      
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            if ($(".role").val() !== '1') {
                alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
            } else {
                $.ajax({
                    type: 'post',
                    url: '?r=bicyclesteamworkinfo/setapproved',
                    data: {dataar:dataar},
                    dataType: 'json',
                    success: function(data) {
                        if (data === 0) {
                            alert("บันทึกถูกยกเลิก");
                        } else if (data === 1) {
                            alert("บันทึกเรียบร้อยแล้ว");
                            location.reload();
                        }
                    }
                });
            }
        }
    });
    
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'ค่าเข้างานนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');

if ($Role == 'IT' || $Role == 'PS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
    <input hidden class="role" value="<?php echo $sys ?>">
    <div class="bicyclesteamwork-info-index">
        <div class="panel">
            <div class="panel panel-body">
                <?php echo $this->render('_search', ["model" => $searchModel, 'Role' => $sys]); ?>
                <hr>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
                    'rowOptions' => function ($model) {
                        return ['id' => ArrayHelper::getValue($model, 'confirms')];
                    },
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                            ],
                            'contentOptions' => function ($model) {
                                if (ArrayHelper::getValue($model, 'checks') != 0) {
                                    return ['class' => 'text-center', 'style' => 'visibility: hidden'];
                                } else {
                                    return ['class' => 'text-center'];
                                }
                            },
                            'checkboxOptions' => function ($model) {
//                            $data = $model->empid . "," . $model->date;
                                $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date');
                                return ['value' => $data];
                            }
                        ],
                        //'idsteamwork',
                        'date:date:วันที่',
                        'empid:text:รหัสพนักงาน',
                        'empName:text:ชื่อ - นามสกุล',
                        'rank:text:ตำแหน่ง',
                        'Extra:integer:เงินพิเศษ',
                        //'confirms',
                        [
                            'attribute' => 'confirms',
                            'format' => 'raw',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center confirms'],
                            'label' => 'สถานะ',
                            'value' => function ($model) {
//                            return $model->confirms == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                                return ArrayHelper::getValue($model, 'confirms') == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['class' => 'text-center'],
                            'template' => '{update} {delete}',
                            'contentOptions' => ['class' => 'text-center'],
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    if (ArrayHelper::getValue($model, 'confirms') == '0') {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', [
                                            'id' => 'updatemodal',
                                            'data-url' => $url
                                        ]);
                                    } else {
                                        if (ArrayHelper::getValue($model, 'role') == '1') {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', [
                                                'id' => 'updatemodal',
                                                'data-url' => $url
                                            ]);
                                        } else {
                                            return '';
                                        }
                                    }
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="return chkdelete($(this))"></span>', 'javascript:void(0)', [
                                        'data-url' => $url,
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $id = ArrayHelper::getValue($model, 'id');
                                $url = 'index.php?r=bicyclesteamworkinfo/' . $action . '&id=' . $id;
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
    "id" => "modal-create",
    "header" => "<h4>เพิ่มข้อมูล</h4>",
    "size" => "modal-lg"
]);
echo '<div class="modalContent"></div>';
Modal::end();

Modal::begin([
    "id" => "modal-update",
    "header" => "<h4>แก้ไขข้อมูล</h4>",
    "size" => "modal-lg"
]);
echo '<div class="modalContent"></div>';
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$alertjs = <<<JS
    var txt = "$res";
    if (txt !== "") { alert(txt); }
JS;
$this->registerJs($alertjs, static::POS_END);
$modaljs = <<<JS
    $(document).on("click","#updatemodal",function() {
        // var x = $(this).attr("data-url");
        // alert(x);
        var modalu = $("#modal-update");
        if (modalu.hasClass("in")) {
            modalu.find(".modalContent").load($(this).attr("data-url"));
        } else {
            modalu.modal("show").find(".modalContent").load($(this).attr("data-url"));
        }
    });   

    $(document).on("click","#createmodal",function(e) {
        e.preventDefault();
        // alert('');
        var modalc = $("#modal-create");
        if (modalc.hasClass("in")) {
            modalc.find(".modalContent").load($(this).attr("href"));
        } else {
            modalc.modal("show").find(".modalContent").load($(this).attr("href"));
        }
    });
JS;
$this->registerJs($modaljs, static::POS_END);
?>