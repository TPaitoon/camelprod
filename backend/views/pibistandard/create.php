<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandard */

$this->title = 'Create Pibistandard';
$this->params['breadcrumbs'][] = ['label' => 'Pibistandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$detaillist = \common\models\PIBIStandard::find()->all();
?>
<div class="pibistandard-create">
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_miniform') ?>
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
                        foreach ($detaillist as $item) { ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->name ?></td>
                                <td><?= $item->refid ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
