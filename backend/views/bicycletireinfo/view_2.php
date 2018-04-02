<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 31/03/2018
 * Time: 9:04
 */

use kartik\detail\DetailView;

/* @var $model backend\models\BicycletireInfo */
?>
<div class="bicycletireinfo-view2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>ข้อมูล : <?= $model->empid ?> ชื่อ : <?= $model->empName ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>รหัสพนักงาน</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->empid ?></td>
                    <td style="text-align: right;width: 15%"><b>ชื่อ - นามสกุล</b></td>
                    <td style="text-align: left;width: 30%"><?= $model->empName ?></td>
                    <td style="text-align: right;width: 10%"><b>วันที่</b></td>
                    <td style="text-align: left;width: 15%"><?= date('d/m/Y',strtotime($model->date)) ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>ชั่วโมงงาน</b></td>
                    <td style="text-align: left"><?= $model->hour ?></td>
                    <td style="text-align: right"><b>มาตรฐาน</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->standard ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>ยอดเตา 1</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->tireamount1 ?></td>
                    <td style="text-align: right;width: 15%"><b>เสียเวลา : นาที</b></td>
                    <td style="text-align: left;width: 30%"><?= $model->losttime ?></td>
                    <td style="text-align: right;width: 10%"><b>ราคา : เส้น</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->tireperpcs ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>ยอดนึ่งเตา 1</b></td>
                    <td style="text-align: left"><?= $model->totaltire ?></td>
                    <td style="text-align: right"><b>ค่าพิเศษเตา 1</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->tirerate1 ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>ยอดเตา 2</b></td>
                    <td style="text-align: left"><?= $model->tireamount2 ?></td>
                    <td style="text-align: right"><b>ค่าพิเศษเตา 2</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->tirerate2 ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>รายการสติกเกอร์</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->stickername ?></td>
                    <td style="text-align: right;width: 15%"><b>ติดสติกเกอร์</b></td>
                    <td style="text-align: left;width: 25%"><?= $model->stickeramount ?></td>
                    <td style="text-align: right;width: 15%"><b>เงินสติกเกอร์</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->stickerrate ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>หักเงิน</b></td>
                    <td style="text-align: left"><?= $model->deduct ?></td>
                    <td style="text-align: right"><b>ค่าพิเศษทั้งหมด</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->totalrate ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
