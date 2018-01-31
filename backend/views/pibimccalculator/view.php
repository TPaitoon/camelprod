<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 1/31/2018
 * Time: 11:00
 */

use common\models\PIBIMCStandardMaster;
use common\models\ShiftList;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBIMCDetail */

$id = explode(",", ArrayHelper::getValue($model, 'recid'));
$this->title = 'ข้อมูล : ' . $id[0];
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในมตซ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimccalculator-view">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>รายละเอียด</h4>
        </div>
        <div class="panel panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'listid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = explode(",",ArrayHelper::getValue($model,'listid'));
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
                    'groupid:raw:กลุ่ม',
                    [
                        'attribute' => 'shiftid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $sid = ArrayHelper::getValue($model, 'shiftid');
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
                        'attribute' => 'date',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $date = ArrayHelper::getValue($model, 'date');
                            return '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($date));
                        },
                        'label' => 'วันที่'
                    ],
                    'hour:raw:ชั่วโมง',
                    [
                        'attribute' => 'itemid',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'itemid');
                            $ls = PIBIMCStandardMaster::find()->select(['name'])->where(['refid' => $id])->one();
                            return $ls->name;
                        },
                        'label' => 'มาตรฐาน'
                    ],
                    'amount:raw:ยอดผลิต',
                    'rate:raw:ค่าพิเศษ : คน',
                ]
            ])
            ?>
        </div>
        <div class="panel panel-footer">
            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
