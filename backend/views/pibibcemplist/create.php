<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBIBCEmplist */

$this->title = 'จัดการพนักงาน.';
$this->params['breadcrumbs'][] = ['label' => 'จัดการพนักงาน.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
<div class="pibibcemplist-create">
    <?= $this->render("_form", ['model' => $model]) ?>
</div>
