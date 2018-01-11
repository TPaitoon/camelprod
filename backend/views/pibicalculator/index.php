<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibicalculatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;

$js1 = <<<JS
    function chkdelete(e) {
        if (confirm('ต้องการลบข้อมูล ?')) {
            // alert(Url);
            if ($(".role").val() !== '1') {
                var status = e.closest('tr').attr('id');
                if (status !== '0') {
                    alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
                } else {
                    var link = e.parent().attr('data-url');
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
                $.ajax({
                    type: 'post',
                    url: link,
                    asnyc: false,
                    cache: false,
                    success: function() {
                        alert('ลบเรียบร้อยแล้ว');
                        location.reload();
                    }
                })
            }
        }
        // e.preventDefault();
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        var dataar = $('input[type=checkbox]:checked').map(function() {
            return $(this).val();
        }).get();
        
        // alert(dataar);
        if (confirm('ต้องการยืนยันข้อมูล ?')) {
            if ($(".role").val() !== '1') {
                alert('ไม่สามารถยืนยันได้เนื่องจากไม่มีสิทธิ์');
            } else {
                $.ajax({
                    type: 'post',
                    url: '?r=pibicalculator/setapproved',
                    data: {dataar:dataar},
                    dataType: 'json',
                    success: function(data) {
                        if (data === 0) {
                            alert('บันทึกถูกยกเลิก');
                        } else {
                        //     alert(data);
                            alert('บันทึกเรียบร้อยแล้ว');
                            location = '?r=pibicalculator'
                        }
                    }
                })
            }
        }
    })
JS;

$this->registerJs($js1, static::POS_END);
if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}
?>
<input hidden class="role" value="<?php echo $sys ?>">
<div class="pibicalculator-index">
    <div class="box box-primary box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
                ],
                'options' => [
                    'id' => 'grid'
                ],
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['id' => ArrayHelper::getValue($model, 'status')];
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'checkboxOptions' => function ($model) {
                            return ['value' => ArrayHelper::getValue($model, 'id')];
                        }
                    ],
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:20%'
                        ],
                        'label' => 'วันที่'
                    ],
                    [
                        'attribute' => 'group',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%'
                        ],
                        'label' => 'กลุ่ม'
                    ],
                    [
                        'attribute' => 'cnt',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%'
                        ],
                        'label' => 'จำนวนคน'
                    ],
                    [
                        'attribute' => 'hour',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%'
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
                        'label' => 'สถานะ',
//                        'value' => function($data) {
////                            return ArrayHelper::getValue($model,'status');
//                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'template' => '{view}  {update}  {delete}',
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, []);
                            },
                            'update' => function ($url,$model) {
                                if (ArrayHelper::getValue($model,'status') == '0') {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                } else if (ArrayHelper::getValue($model,'role') == '1') {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                } else {
                                    return '';
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
                            $url = 'index.php?r=pibicalculator/'. $action .'&id=' . $id;
                            return $url;
                        }
                    ],
                ]
            ])
            ?>
        </div>
    </div>
</div>
