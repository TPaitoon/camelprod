<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:29 AM
 */
$this->title = 'Create Pibicalculator';
$this->params['breadcrumbs'][] = ['label' => 'Pibicalculators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibicalculator-create">
    <div class="box box-primary box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>