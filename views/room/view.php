<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = 'Номер ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="room-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => "/"
    ]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'type',
            'quantity',
            'price',
            'free',
            'option',
            'photo',
        ],
    ]) ?>
    <p>Номер со всеми опциями будет стоит <?= $reserveRoom->price?> рублей<p>
    <p>
        <?= Html::a('Забронировать', ['/'], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Вы хотите забронировать номер ' . $model->id . '?',
                'method' => 'get',
            ],
        ]) ?>
    </p>
<?php ActiveForm::end(); ?>
</div>
