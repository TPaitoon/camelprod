<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 05/05/2018
 * Time: 16:09
 */
?>
<div class="col-md-12">
    <h4>จำนวณ : <label id="count" style="color: #00a65a">#</label> แถว</h4>
</div>
<form id="bc-info" action="index.php?r=bicycleinfo/createmanual" method="post">
    <div class="col-md-12">
        <div style="overflow-x: scroll">
            <table class="table table-bordered listemp">
                <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>วันที่</th>
                    <th>รายการยาง</th>
                    <th>กลุ่มยาง</th>
                    <th>ยอดผลิต</th>
                    <th>เสียดวลา : นาที</th>
                    <th>ยอดยาง</th>
                    <th>ราคา : เส้น</th>
                    <th>ค่าพิเศษ : วัน</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</form>