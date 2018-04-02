<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 02/04/2018
 * Time: 9:07
 */
/* @var $model backend\models\BOMInfo */
?>
<div class="bominfo-view2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>ช้อมูล : <?= $model->empid ?> ชื่อ : <?= $model->empName ?></h4>
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
                    <td style="text-align: left"><?= $model->standard ?></td>
                    <td style="text-align: right"><b>เตาที่</b></td>
                    <td style="text-align: left"><?= $model->stoveid ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>ยอดนึ่ง</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->amount ?></td>
                    <td style="text-align: right;width: 15%"><b>เสียเวลา : นาที</b></td>
                    <td style="text-align: left;width: 25%"><?= $model->losttime ?></td>
                    <td style="text-align: right;width: 15%"><b>ยอดยาง</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->totaltire ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>ราคา : เส้น</b></td>
                    <td style="text-align: left"><?= $model->perpcs ?></td>
                    <td style="text-align: right"><b>หักเงิน</b></td>
                    <td style="text-align: left"><?= $model->deduct ?></td>
                    <td style="text-align: right"><b>ค่าพิเศษ</b></td>
                    <td style="text-align: left"><?= $model->rate ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>