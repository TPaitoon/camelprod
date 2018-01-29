<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycleinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS
    
    function chkdelete() {
      return confirm('ต้องการลบข้อมูล ?');
    }
    
     $("#binfo").on('click',function(e) {
        e.preventDefault();
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            // alert(ids);
            var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
            // alert(dataar);
            $.ajax({
                type: 'post',
                url: '?r=bicycleinfo/setapproved',
                data: {dataar:dataar},
                dataType: 'json',
                success: function(data) {
                    if (data === 0) {
                        alert("บันทึกถูกยกเลิก");
                    } else if(data === 1) {
                        alert("บันทึกเรียบร้อยแล้ว");
                        location.reload();
                    }
                }
            });
        }
    })
    
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'ค่าพิเศษประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
    <div class="bicycle-info-index">
        <div class="panel">
            <div class="panel panel-body">
                <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
                <hr>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
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
                                $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date');
                                return ['value' => $data];
                            }
                        ],
                        //'id',
                        'empid:text:รหัสพนักงาน',
                        'empname:text:ชื่อ - นามสกุล',
                        //'typeid',
                        //'qty',
                        'date:date:วันที่',
                        'tirename:text:เบอร์ยาง',
                        // 'checks',
                        // 'minus',
                        'grouptire:integer:กลุ่มยาง',
                        'amount:integer:ยอดผลิต',
                        'losttime:integer:เสียเวลา : นาที',
                        'minus:integer:ยอดยาง',
                        'perpcs:text:ราคา : เส้น',
                        'rate:text:ค่าพิเศษ : วัน',
                        'checks:raw:สถานะ',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'update' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="return chkdelete()"></span>', $url, []);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $empid = ArrayHelper::getValue($model, 'empid');
                                $date = ArrayHelper::getValue($model, 'date');
                                if ($action == 'update') {
                                    $url = 'index.php?r=bicycleinfo/update&empid=' . $empid . '&date=' . $date;
                                    return $url;
                                }
                                if ($action == 'delete') {
                                    $url = 'index.php?r=bicycleinfo/delete&empid=' . $empid . '&date=' . $date;
                                    return $url;
                                }
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>