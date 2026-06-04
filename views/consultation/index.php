<?php

use app\models\Consultation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заяки на консультацию';
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Consultation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
