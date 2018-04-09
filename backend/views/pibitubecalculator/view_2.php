<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 09/04/2018
 * Time: 14:17
 */
/* @var $model backend\models\PIBITubeDetail */
?>
<div class="pibitubecalculator-view2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $sh = \common\models\ShiftList::findOne(['id' => $model->shift]) ?>
            <h4>ข้อมูลกะ : <?= $sh->shiftname ?> | วันที่ <?= date('d/m/Y',strtotime($model->date)) ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody style="background-color: transparent; color: #1a2226">
                <tr>
                    <td style="text-align: right"><b>รหัสพนักงาน</b></td>
                    <td style="text-align: left"><?= $model->listid ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>