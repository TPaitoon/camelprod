<?php
/**
 * Created by PhpStorm.
 * User: Walofz
 * Date: 02/04/2018
 * Time: 21:26 PM
 */

/* @var $model backend\models\BicycleInfo */
?>
<div class="bicycleinfo-view2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>ข้อมูล : <?= $model->empid ?> ชื่อ : <?= $model->empname ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>รหัสพนักงาน</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->empid ?></td>
                    <td style="text-align: right;width: 15%"><b>ชื่อ - นามสกุล</b></td>
                    <td style="text-align: left;width: 30%"><?= $model->empname ?></td>
                    <td style="text-align: right;width: 10%"><b>วันที่</b></td>
                    <td style="text-align: left;width: 15%"><?= date('d/m/Y', strtotime($model->date)) ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>กลุ่มยาง</b></td>
                    <td style="text-align: left"><?= $model->grouptire ?></td>
                    <td style="text-align: right"><b>รายการยาง</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->tirename ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent;color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>ยอดผลิต</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->amount ?></td>
                    <td style="text-align: right;width: 15%"><b>เสียเวลา : นาที</b></td>
                    <td style="text-align: left;width: 25%"><?= $model->losttime ?></td>
                    <td style="text-align: right;width: 15%"><b>ยอดยาง</b></td>
                    <td style="text-align: left;width: 15%"><?= $model->minus ?></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>ราคา : เส้น</b></td>
                    <td style="text-align: left"><?= $model->perpcs ?></td>
                    <td style="text-align: right"><b>ค่าพิเศษ : วัน</b></td>
                    <td style="text-align: left" colspan="3"><?= $model->rate ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
