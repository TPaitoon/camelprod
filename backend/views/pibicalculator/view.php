<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 24/01/2018
 * Time: 09:05 AM
 */

use common\models\PIBIStandard;
use common\models\ShiftList;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\PIBICalculator */

$id = explode(",", ArrayHelper::getValue($model, 'recid'));
$this->title = 'ข้อมูล : ' . $id[0];
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pibicalculator-view">
        <div class="panel">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'listid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = explode(",", ArrayHelper::getValue($model, 'listid'));
                            $_temp = null;
                            for ($i = 0; $i < count($id); $i++) {
                                if ($i == 0) {
                                    $_temp = $id[$i] . "<br>";
                                } else {
                                    $_temp = $_temp . $id[$i] . "<br>";
                                }
                            }

                            return $_temp;
                        },
                        'label' => 'พนักงาน'
                    ],
                    'Groupid:raw:กลุ่ม',
                    [
                        'attribute' => 'Shiftid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $sid = ArrayHelper::getValue($model, 'Shiftid');
                            $mshift = ShiftList::find()->where(['id' => $sid])->one();
                            if ($sid == 1) {
                                return '<label class="label label-primary">' . $mshift->shiftname . '</label>';
                            } elseif ($sid == 2) {
                                return '<label class="label label-warning">' . $mshift->shiftname . '</label>';
                            }
                        },
                        'label' => 'ช่วงทำงาน'
                    ],
                    [
                        'attribute' => 'Date',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $date = ArrayHelper::getValue($model, 'Date');
                            return '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($date));
                        },
                        'label' => 'วันที่'
                    ],
                    'Hour:raw:ชั่วโมง',
                    [
                        'attribute' => 'Itemid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'Itemid');
                            $ls = PIBIStandard::find()->select(['name'])->where(['refid' => $id])->one();
                            return $ls->name;
                        },
                        'label' => 'มาตรฐาน'
                    ],
                    'amount:raw:ยอดผลิต',
                    'Rate:raw:ค่าพิเศษ : คน',
                ]
            ])
            ?>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>