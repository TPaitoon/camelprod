<?php

use backend\models\Userinfo;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExtrainfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$js = <<<JS
    function chkdelete() {
      return confirm('ต้องการลบข้อมูล ?');
    }
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'Standard BOM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-info-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?= Html::a('เพิ่มมาตารฐานเตา', ['create'], ['class' => 'btn btn-success']) ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['id' => $model['id']];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
//                    'name',
//                    'values',
//                    'min',
//                    'max',
//                    'rate',
//                    [
//                        'attribute' => 'name',
//                        'label' => 'มาตรฐาน'
//                    ],
//                    [
//                        'attribute' => 'min',
//                        'label' => 'ค่าต่ำสุด'
//                    ],
//                    [
//                        'attribute' => 'max',
//                        'label' => 'ค่าสูงสุด'
//                    ],
//                    [
//                        'attribute' => 'rate',
//                        'label' => 'ค่าพิเศษ',
//                    ],
                    'name:text:มาตรฐาน',
                    'min:integer:ค่าต่ำสุด',
                    'max:text:ค่าสูงสุด',
                    'rate:text:ค่าพิเศษ',
                    ['class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['class' => 'text-center'],
                        'template' => '{update}{delete}',
                        'contentOptions' => ['class' => 'text-center'],
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"  onclick="return chkdelete()"></span>', $url, []);
                            }
                        ],
                        'urlCreator' => function ($action, $model) {
                            $id = ArrayHelper::getValue($model, 'id');
                            if ($action === 'update') {
                                $url = 'index.php?r=extrainfo/update&&id=' . $id;
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = 'index.php?r=extrainfo/delete&id=' . $id;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
