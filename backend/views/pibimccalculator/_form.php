<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 26/01/2018
 * Time: 15:07 PM
 */

use common\models\EmpInfo;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCMaster */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])
    ->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();


?>