<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibimcemplistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pibimcemplists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimcemplist-index">
    <div class="panel">
        <div class="panel panel-body">
            <?= Html::a("เพิ่มข้อมูล", ["create"], ["class" => "btn btn-success"]) ?>
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
                    ]
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
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>
