<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                [
                        'label' => 'ФИО',
                        'value' => static fn( \app\models\Consultation $model) => $model->user->full_name,
                ],

                [
                        'attribute' => 'consultation_name',
                        'value' => static fn(\app\models\Consultation $model) => $model->displayConsultationName(),
                ],

                [
                        'attribute' => 'start_date',
                        'format' => ['date', 'php:d-m-Y'],
                ],

                [
                        'attribute' => 'start_time',
                        'format' => ['time', 'php:H:i:s'],
                ],

                [
                        'attribute' => 'payment_method',
                        'value' => static fn (\app\models\Consultation $model)=> $model->displayPaymentMethod(),
                ],



                [
                        'label' => 'Изменить статус',
                        'format' => 'raw',
                        'value' => function($model) {
                            $isCompleted = $model->status === 'completed';
                            return Html::beginForm(['update-status'], 'post', ['class' => 'd-flex gap-2'])  .
                                Html::hiddenInput('id', $model->id) .
                                Html::dropDownList('status', $model->status, app\models\Consultation::optsStatus(),
                                [
                                        'class' => 'form-select form-select-sm',
                                        'style' => 'max-width: 220px',
                                        'disabled' => $isCompleted,
                                ]) .
                                Html::submitButton('Сохранить',
                                        ['class' => 'btn btn-sm btn-primary',
                                         'disabled' => $isCompleted,
                                        ]) .
                                Html::endForm();
                        },
                ],
        ],
    ]); ?>


</div>
