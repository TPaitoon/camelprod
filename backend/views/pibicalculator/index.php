<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibi/script.js?Ver=0001', ['depends' => JqueryAsset::className()]);

?>
<input hidden class="role" value="<?php echo $role ?>">
<div class="pibicalculator-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
                ],
                'options' => [
                    'id' => 'grid',
                ],
                'rowOptions' => function ($model) {
                    return ['id' => ArrayHelper::getValue($model, 'status')];
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:5%'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:5%'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'checkboxOptions' => function ($model) {
                            $v = ArrayHelper::getValue($model, 'id') . ':';
                            return ['value' => $v];
                        }
                    ],
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'value' => function ($model) {
                            return '<i class="fa fa-calendar">' . ' ' . date('d/m/Y',strtotime(ArrayHelper::getValue($model, 'date')));
                        },
                        'label' => 'วันที่'
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
                        'label' => 'กลุ่ม'
                    ],
                    [
                        'attribute' => 'cnt',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'label' => 'จำนวณคน'
                    ],
                    [
                        'attribute' => 'hour',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
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
                        'label' => 'สถานะ'
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
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, []);
                            },
                            'update' => function ($url, $model) {
                                $st = ArrayHelper::getValue($model, 'status');
                                $rl = ArrayHelper::getValue($model, 'role');

                                if ($st == 0) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                } elseif ($rl == 1) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                } else {
                                    return '';
                                }
                            },
                            'delete' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', [
                                    'data-url' => $url,
                                ]);
                            }
                        ],
                        'urlCreator' => function ($action, $model) {
                            $id = ArrayHelper::getValue($model, 'id');
                            $url = '?r=pibicalculator/' . $action . '&id=' . $id;
                            return $url;
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
