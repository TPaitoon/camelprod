<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycleempinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าเข้างานประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;

$JS = <<<JS
    function chkdelete() {
        return confirm('ต้องการลบข้อมูล ?');
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        var dataar = $('input[type=checkbox]:checked').map(function() {
            return $(this).val();
        }).get();
        
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            // alert(ids);
            $.ajax({
                type: 'post',
                url: '?r=bicycleempinfo/setapproved',
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
$this->registerJs($JS, static::POS_END);
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}
?>
<div class="bicycle-emp-info-index">
    <div class="panel">
        <div class="panel panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'checkboxOptions' => function ($model) {
                            $data = $model->empid . ',' . $model->date;
                            return ['value' => $data];
                        }
                    ],
                    //'id',
                    'empid:text:รหัสพนักงาน',
                    'empName:text:ชื่อ - นามสกุล',
                    'rank:text:ตำแหน่ง',
                    'Extra:integer:เงินพิเศษ',
                    'date:date:วันที่',
                    //'confirms:raw:สถานะ',
                    [
                        'attribute' => 'confirms',
                        'format' => 'raw',
                        'label' => 'สถานะ',
                        'value' => function ($model) {
                            return $model->confirms == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                        ],
                        'template' => '{update}{delete}',
                        'contentOptions' => [
                            'class' => 'text-center',
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
