<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 05/02/2018
 * Time: 11:17
 */

/* @var $this yii\web\View */
/* @var $model backend\models\PIBITubeDetail */

$this->title = 'ค่าพิเศษพนักงานเตรียมจุ๊บ.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษพนักงานเตรียมจุ๊บ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="pibitubecalculator-create">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>เพิ่มข้อมูล</h4>
        </div>
        <div class="panel panel-body">
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>
    </div>
</div>
