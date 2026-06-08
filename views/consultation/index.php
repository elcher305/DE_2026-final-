<?php

use app\models\Consultation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оставить Заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [
                'attribute' => 'consultation_name',
                'value' => static fn(Consultation $model) => $model->displayConsultationName(),
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
                'value' => static fn (Consultation $model)=> $model->displayPaymentMethod(),
            ],

            [
                'attribute' => 'status',
                'value' => static fn (Consultation $model)=> $model->displayStatus(),
            ],

            [
               'label' => 'Действие',
               'format' => 'raw',
               'value' => function( Consultation  $model) {
                    if ($model->status === Consultation::STATUS_APPROVED
                    && !$model->getReviews()->andWhere(['user_id' => \Yii::$app->user->id])->exists()){
                        return Html::a('Оставить отзыв', ['/review/create', 'consultation_id' => $model->id],
                        ['class' => 'btn btn-primary']);
                    }
                    return '-';
               },
            ],
        ],
    ]); ?>


</div>
