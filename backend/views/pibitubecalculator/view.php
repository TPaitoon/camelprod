<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 14:41
 */

use common\models\ShiftList;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PIBITubeDetail */

?>
<div class="pibitubecalculator-view">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>รายละเอียด</h4>
        </div>
        <div class="panel panel-body">
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
                        /* Wait Edit */
                    ]
                ]
            ]) ?>
        </div>
    </div>
</div>
