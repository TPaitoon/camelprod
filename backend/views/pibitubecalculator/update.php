<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 07/02/2018
 * Time: 13:57
 */

/* @var $model backend\models\PIBITubeDetail */
/* @var $this yii\web\View */
$this->title = "ข้อมูล : " . $title;
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษพนักงานเตรียมจุ๊บ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitubecalculator-update">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>แก้ไขข้อมูล</h4>
        </div>
        <div class="panel panel-body">
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>
    </div>
</div>
