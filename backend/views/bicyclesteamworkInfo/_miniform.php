<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 07/05/2018
 * Time: 13:52
 */
?>
<div class="col-lg-12">
    <h4>จำนวณ : <label id="count" style="color: #00a65a">#</label> แถว</h4>
</div>
<div class="col-lg-12">
    <div class="row">
        <form action="index.php?r=bicyclesteamworkinfo/createmanual" id="bcsteamwork-form" method="post">
            <div style="overflow-x: scroll">
                <table class="table table-bordered listemp">
                    <thead>
                    <tr>
                        <th>รหัสพนักงาน</th>
                        <th>วันที่</th>
                        <th>ตำแหน่ง</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input readonly type="text" name="empidx" class="form-control empids"></td>
                        <td><input readonly type="text" name="datex" class="form-control dates"></td>
                        <td><input readonly type="text" name="sectionx" class="form-control sections"></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger" onclick="removegroupline($(this))"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>