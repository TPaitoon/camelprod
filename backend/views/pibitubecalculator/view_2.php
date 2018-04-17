<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 09/04/2018
 * Time: 14:17
 */

use common\models\ShiftList;
use yii\helpers\ArrayHelper;

/* @var $model backend\models\PIBITubeDetail */

//print_r(count($model->itemlist));
?>
<div class="pibitubecalculator-view2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $sh = ShiftList::findOne(['id' => $model->shift]) ?>
            <h4>ข้อมูลกะ : <?= $sh->shiftname ?> | วันที่ <?= date('d/m/Y', strtotime($model->date)) ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody style="background-color: transparent; color: #1a2226">
                <?php $listemp = explode(",", $model->listid); ?>
                <?php for ($i = 0; $i < count($listemp); $i++) { ?>
                    <?php $exemp = explode("|", $listemp[$i]); ?>
                    <tr>
                        <td style="text-align: right;width: 15%"><b>รหัสพนักงาน</b></td>
                        <td style="text-align: left;width: 15%"><?= $exemp[0] ?></td>
                        <td style="text-align: right;width: 15%"><b>ชื่อ - นามสกุล</b></td>
                        <?php if ($i == 0) { ?>
                            <td style="text-align: left;width: 30%"><?= $exemp[1] ?></td>
                            <td style="text-align: right;width: 10%"><b>วันที่</b></td>
                            <td style="text-align: left;width: 15%"><?= date('d/m/Y', strtotime($model->date)) ?></td>
                        <?php } else { ?>
                            <td style="text-align: left;width: 30%" colspan="3"><?= $exemp[1] ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent; color: #1a2226">
                <tr>
                    <td style="text-align: right;width: 15%"><b>ช่วงทำงาน</b></td>
                    <?php $_temp = ShiftList::findOne(["id" => $model->shift]) ?>
                    <td style="text-align: left;width: 15%"><?= $_temp->shiftname ?></td>
                    <td style="text-align: right;width: 20%"><b>ยอดผลิต (ทั้งหมด)</b></td>
                    <td style="text-align: left;width: 50%"><?= $model->itemid ?> &ensp; <b>Pcs.</b></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent; color: #1a2226">
                <tr>
                    <td style="text-align: left" colspan="4"><i class="fa fa-info-circle"></i> &ensp; <b>ยอดผลิต (แบ่งตามกลุ่ม)</b></td>
                </tr>
                <?php for ($i = 0; $i < count($model->itemlist); $i++) { ?>
                    <tr>
                        <td style="text-align: right;width: 15%"><b>กลุ่ม</b></td>
                        <td style="text-align: left;width: 15%"><?= ArrayHelper::getValue($model, 'itemlist')[$i]['group'] ?></td>
                        <td style="text-align: right;width: 20%"><b>ยอดผลิต</b></td>
                        <td style="text-align: left;width: 50%"><?= ArrayHelper::getValue($model, 'itemlist')[$i]['value'] ?> &ensp;
                            <b>Pcs.</b></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody style="background-color: transparent; color: #1a2226">
                // Wait Edit //
                </tbody>
            </table>
        </div>
    </div>
</div>