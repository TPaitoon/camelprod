<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraInfo */
$name = \backend\models\ExtraInfo::find()->select(['ExtraName'])->where(['extra_id' => $model->extra_id])->one();
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name->ExtraName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<br>
<div class="box box-success box-solid">
    <div class="box-header">
        <h4><span>ข้อมูล : <?php echo $name->ExtraName ?></span></h4>
    </div>
    <div class="box-body ">
        <?= $this->render('_form', [
            'model' => $model,
//            'extra' => $extra,
//            'extradetail' => $extradetail,
        ]) ?>
    </div>

</div>
