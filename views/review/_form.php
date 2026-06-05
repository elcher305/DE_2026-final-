<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Review $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(
            ['value' => \Yii::$app->user->identity->id]
    )->label(false) ?>

    <?= $form->field($model, 'consultation_id')->hiddenInput(
            ['value' => \Yii::$app->request->get('consultation_id')]
    )->label(false) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])
        ->label("Как вам качество услуги?")?>

    <div class="form-group">
        <?= Html::submitButton('Отправть отзыв', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
