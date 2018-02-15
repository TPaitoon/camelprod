<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitubeemplistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการพนักงาน.';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pibitube-emplist-index">
        <div class="panel">
            <div class="panel panel-body">
                <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="panel">
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider1,
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
                                'style' => 'width:15%',
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
                        ]
                    ]
                ]) ?>
            </div>
        </div>
        <div class="panel">
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider2,
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
                                'style' => 'width:15%',
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
                        ]
                    ]
                ]) ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css?Ver=0001", ['depends' => JqueryAsset::className()]);
?>