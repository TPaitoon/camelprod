<?php

/* @var $this yii\web\View */

use yii\grid\GridView;

$this->title = 'Login History';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-success box-solid">
    <div class="box-header">
        <label style="font-size: medium">ประวัติเข้าสู่ระบบ</label>
        <hr>
    </div>
    <div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'username:text:ชื่อผู้ใช้งาน',
                [
                    'attribute' => 'log_at',
                    'format' => 'datetime',
                    'label' => 'เข้าใช้งานเมื่อ',
                ]
            ],
        ]) ?>
    </div>
</div>
