<?php

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCStandardDetail */

$this->title = 'มาตรฐานประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = ['label' => 'มาตรฐานประกอบยางในมตซ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูลมาตรฐาน';
$detaillist = \common\models\PIBIMCStandardMaster::find()->all();
?>

<div class="pibimcstandard-create">
    <div class="panel">
        <div class="panel panel-body">
            <?= $this->render('_formmaster', ['model' => $model]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel panel-body">
            <?= $this->render('_miniformmaster', ['model' => $model]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <div class="col-lg-4">
                <div class="row">
                    <h4>ประวัติ</h4>
                    <table class="table table-bordered">
                        <thead>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Refid</th>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($detaillist as $i) { ?>
                            <tr>
                                <td><?= $i->id ?></td>
                                <td><?= $i->name ?></td>
                                <td><?= $i->refid ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
