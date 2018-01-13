<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:34 AM
 */

use common\models\EmpInfo;

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();
