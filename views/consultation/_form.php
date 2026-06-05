<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Consultation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="consultation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consultation_name')->dropDownList([
            'civil' => 'гражданского',
            'criminal' => 'уголовного',
            'administrative' => 'административного',
            'legal' => 'юридического',
            ],
            ['prompt' => 'Выберите тип консультации']) ?>

    <?= $form->field($model, 'start_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'start_time')->textInput(['type' => 'time']) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([
            'QR code' => 'предоплата по QR-коду',
            'cash' => ' постоплата в офисе организации',
            'transaction' => 'оплата картой МИР',
            ],
            ['prompt' => 'Выберите способ оплаты']) ?>



    <div class="form-group">
        <?= Html::submitButton('Записаться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
