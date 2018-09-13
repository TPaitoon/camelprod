<?php

/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 12/09/2018
 * Time: 13:17
 */

/* @var $this \yii\web\View */
?>
<h4>Record : <label id="count" style="color: #00a65a"># </label></h4>
<div class="col-md-12">
    <div class="row">
        <form action="?r=pibitirecutdetail/createmanual" id="0tirecut-form" method="post">
            <div style="overflow-x: scroll">
                <table class="table table-bordered listemp">
                    <thead>
                    <tr>
                        <th>รหัสพนักงาน</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>วันที่</th>
                        <th>ตำแหน่ง</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="empidx[]" class="form-control empids"></td>
                        <td><input type="text" name="empnamex[]" class="form-control empnames"></td>
                        <td><input type="text" name="datex[]" class="form-control dates" readonly></td>
                        <td><input type="text" name="secx[]" class="form-control secs" readonly></td>
                        <td class="text-center"><button type="button" class="btn btn-danger btn-lg fa fa-minus " onclick="removeline($(this))"></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>