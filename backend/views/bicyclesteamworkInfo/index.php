<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

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
$this->title = 'Steam Bicycle Employee Rate';
$this->params['breadcrumbs'][] = $this->title;

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
<input hidden class="role" value="<?php echo $sys ?>">
<div class="bicyclesteamwork-info-index">
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?php echo $this->render('_search', ["model" => $searchModel, 'Role' => $sys]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
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
                        'contentOptions' => [
                            'class' => 'text-center',
                        ],
                        'checkboxOptions' => function ($model) {
//                            $data = $model->empid . "," . $model->date;
                            $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date');
                            return ['value' => $data];
                        }
                    ],
                    //'idsteamwork',
                    'empid:text:รหัสพนักงาน',
                    'empName:text:ชื่อ - นามสกุล',
                    'rank:text:ตำแหน่ง',
                    'Extra:integer:เงินพิเศษ',
                    'date:date:วันที่',
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
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                } else {
                                    if (ArrayHelper::getValue($model, 'role') == '1') {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                    } else {
                                        return '';
                                    }
                                }
                            },
                            'delete' => function ($url, $model) {
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
