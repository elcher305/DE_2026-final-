<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Review $model */

$this->title = 'Оставить отзыв об качестве услуги';
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
