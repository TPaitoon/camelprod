<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 14:41
 */

use common\models\PIBITubeMaster;
use common\models\ShiftList;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBITubeDetail */

?>
    <div class="pibitubecalculator-view">
        <div class="panel">
            <?= DetailView::widget([
                "model" => $model,
                "attributes" => [
                    [
                        "attribute" => "listid",
                        "format" => "raw",
                        "value" => function ($model) {
                            $id = explode(",", ArrayHelper::getValue($model, "listid"));
                            $_temp = null;
                            for ($i = 0; $i < count($id); $i++) {
                                if ($i === 0) {
                                    $_temp = $id[$i] . "<br>";
                                } else {
                                    $_temp = $_temp . $id[$i] . "<br>";
                                }
                            }
                            return $_temp;
                        },
                        "label" => "พนักงาน"
                    ],
                    [
                        "attribute" => "shift",
                        "format" => "raw",
                        "value" => function ($model) {
                            $sid = ArrayHelper::getValue($model, "shift");
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
                        "attribute" => "date",
                        "format" => "raw",
                        "value" => function ($model) {
                            $date = ArrayHelper::getValue($model, 'date');
                            return '<i class="fa fa-calendar text-success"></i>' . '<span style="padding-left: 10px"></span>' . date('d-m-Y', strtotime($date));
                        },
                        "label" => "วันที่"
                    ],
                    [
                        "attribute" => "itemid",
                        "format" => "raw",
                        "value" => function ($model) {
                            return ArrayHelper::getValue($model, "itemid") . " เส้น";
                        },
                        "label" => "ยอดผลิต"
                    ],
                    "losttube1:raw:จุ๊บเสีย (ก่อนนึ่ง)",
                    "losttube2:raw:จุ๊บเสีย (หลังนึ่ง)",
                    [
                        "attribute" => "car",
                        "format" => "raw",
                        "value" => function ($model) {
                            if (ArrayHelper::getValue($model, "car") === 0) {
                                $col = "label label-success";
                                $txt = "ไม่หัก";
                            } else {
                                $col = "label label-danger";
                                $txt = "หัก";
                            }
                            return '<label class="' . $col . '">' . $txt . '</label>';
                        },
                        "label" => "5 ส."
                    ],
                    "rate:raw:ค่าพิเศษ : คน",
                    [
                        "attribute" => "refid",
                        "format" => "raw",
                        "value" => function ($model) {
                            $_temps = PIBITubeMaster::find()->select(['status'])->where(['id' => ArrayHelper::getValue($model, "refid")])->one();
                            if ($_temps->status === 1) {
                                $col = "label label-success";
                                $txt = "Approved";
                            } else {
                                $col = "label label-info";
                                $txt = "Created";
                            }
                            return '<label class="' . $col . '">' . $txt . '</label>';
                        },
                        "label" => "สถานะ"
                    ],
                ]
            ]) ?>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . "/css/panel.css", ['depends' => JqueryAsset::className()]);
?>