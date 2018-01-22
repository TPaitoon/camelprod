<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);

?>
<div class="pibicalculator-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
            <br><br>
            For Reander->Search
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ]
                    ],
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:20%'
                        ],
                        'label' => 'วันที'
                    ]
                ],
            ]) ?>
        </div>
    </div>
</div>
