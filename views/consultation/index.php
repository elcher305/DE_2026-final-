<?php

use app\models\Consultation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row g-4'],
            'itemOptions' => ['class' => 'col-md-4'],
            'pager' => [
                'options' => ['class' => 'pagination justify-content-center gap-1'],
                'linkOptions' => ['class' => 'page-link d-flex justify-content-between'],
                'disabledListItemSubTagOptions' => ['class' => 'page-link'],
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                $isCompleted = $model->status === 'completed';
                return '
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title">
                            Заявка № '.Html::encode($key).'
                        </h5>
                    </div>
                      <div class="card-body">
                        <p class="d-flex justify-content-between">
                            <b>ФИО:</b>
                            '.$model->user->full_name.'
                        </p>
                         <p class="d-flex justify-content-between">
                            <b>Название консультации:</b>
                            <span class="text-end">'.$model->displayConsultationName().'</span>
                        </p> 
                         <p class="d-flex justify-content-between">
                            <b>Дата начала:</b>
                            '.date('d.m.Y H:i', strtotime($model->start_date)).'
                        </p>
                         <p class="d-flex justify-content-between">
                            <b>Способ оплаты:</b>
                            '.$model->displayPaymentMethod().'
                        </p>   
                    </div>
                    <div class="card-footer">
                    '.Html::beginForm(['update-status'], 'post', ['class' => 'd-flex justify-content-between']).
                            Html::hiddenInput('id', $model->id) .
                            Html::dropDownList('status', $model->status, app\models\Consultation::optsStatus(),
                            [
                                    'class' => 'form-select form-select-sm',
                                    'style' => 'max-width: 220px',
                                    'disabled' => $isCompleted,
                            ])  .
                            Html::submitButton('Сохранить', [
                                    'class' => 'btn btn-sm btn-primary',
                                    'disabled' => $isCompleted,
                                    ]) .
                            Html::endForm() .'
                    </div>
                </div>
                ';
            }
    ]);
    ?>
    <p>
        <?= Html::a('Оставить Заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




</div>
