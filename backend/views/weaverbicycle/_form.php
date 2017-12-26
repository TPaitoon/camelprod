<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Weaverbicycle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weaverbicycle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sizename')->textInput() ?>

    <?= $form->field($model, 'groups')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
