<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicyclesteamworkinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS

    function chkdelete() {
        return confirm('ต้องการลบข้อมูล ?');      
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
      
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
                            $data = $model->empid . "," . $model->date;
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
                        'label' => 'สถานะ',
                        'value' => function ($model) {
                            return $model->confirms == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['class' => 'text-center'],
                        'template' => '{update}{delete}',
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
