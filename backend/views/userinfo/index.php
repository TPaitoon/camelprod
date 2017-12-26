<?php

use backend\models\Userinfo;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Userinfos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userinfo-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success box-solid">
        <div class="box-body">
            <?= Html::a('เพิ่มข้อมูลผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'Firstname:text:ชื่อ',
                    'Lastname:text:นามสกุล',
                    'username:text:ชื่อผู้ใช้งาน',
                    'Dept:text:แผนก',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'การทำงาน',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'template' => '{update}{delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
