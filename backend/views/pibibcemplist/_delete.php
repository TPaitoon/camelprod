<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 19/04/2018
 * Time: 9:57
 */

use common\models\ShiftList;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$shiftlist = ShiftList::find()->all();
$grouplist = [];
for ($i = 1; $i <= 15; $i++) {
    array_push($grouplist, ['A' => $i]);
}
?>
<div class="pibibcemplist-delete">
    <div class="row">
        <div class="col-lg-4">
            <?= Select2::widget([
                "name" => "shiftselect",
                "data" => ArrayHelper::map($shiftlist, "id", "shiftname"),
                "options" => [
                    "placeholder" => "เลือกช่วงทำงาน",
                    "id" => "shiftselect"
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= Select2::widget([
                "name" => "groupselect",
                "data" => ArrayHelper::map($grouplist, "A", "A"),
                "options" => [
                    "placeholder" => "เลือกกลุ่ม",
                    "id" => "groupselect"
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-danger delete">ลบข้อมูล</button>
        </div>
    </div>
</div>