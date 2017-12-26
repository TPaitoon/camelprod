<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Userinfo */

$this->title = 'Userinfo: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Userinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userinfo-update">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <label style="font-size: x-large">แก้ไขข้อมูล</label>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
