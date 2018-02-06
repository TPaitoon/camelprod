<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 14:05
 */

/* @var $model backend\models\PIBITubeDetail */
/* @var $group */
?>
<table class="table table-bordered listqty">
    <thead>
    <tr>
        <th width="100">กลุ่มที่</th>
        <th>ยอดเตรียมจุ๊บ</th>
        <th class="text-center">#</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <input type="text" name="groups[]" class="form-control groups" readonly>
        </td>
        <td>
            <input type="text" name="values[]" class="form-control values" readonly>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-minus"></i>
            </button>
        </td>
    </tr>
    </tbody>
</table>
