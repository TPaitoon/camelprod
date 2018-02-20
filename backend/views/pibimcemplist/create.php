<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCEmplist */

$this->title = 'จัดการพนักงาน.';
$this->params['breadcrumbs'][] = ['label' => 'จัดการพนักงาน.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="pibimcemplist-create">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>เพิ่มข้อมูล</h4>
        </div>
        <div class="panel panel-body">
            <?= $this->render("_form", ['model' => $model]) ?>
        </div>
    </div>
</div>
