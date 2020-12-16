<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наши номера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<table class="table">
            <thead>
                <tr>
                    <td>Номер</td>
                    <td>Тип номера</td>
                    <td>Время заезда</td>
                    <td>Время отъезда</td>
                    <td>Опции</td>
                    <td>Цена</td>
                    <td>Фото</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rooms as $room):?>
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => "choose?id=".$room->id 
                    ]); 
                    ?>
                    <tr>
                        <td><?= $room->number?></td>
                        <td><?= $room->type?></td>
                        <td>    <?php echo '<label>Время заезда</label>';
                                    echo DateTimePicker::widget([
                                    'name' => 'date_arrival',
                                    'options' => ['placeholder' => 'Выберите время заезда'],
                                    'convertFormat' => true,
                                    'pluginOptions' => [
                                        'format' => 'd-M-Y g:i A',
                                        'startDate' => '01-Mar-2020 12:00 AM',
                                        'todayHighlight' => true
                                ]
                            ]);
                        ?></td>
                        <td>    <?php echo '<label>Время отъезда</label>';
                                    echo DateTimePicker::widget([
                                    'name' => 'date_departure',
                                    'options' => ['placeholder' => 'Выберите время отъезда'],
                                    'convertFormat' => true,
                                    'pluginOptions' => [
                                        'format' => 'd-M-Y g:i A',
                                        'startDate' => '01-Mar-2020 12:00 AM',
                                        'todayHighlight' => true
                                ]
                            ]);
                        ?></td>
                        <td><?php if ($room->option == 3) :?>
                        <?php
                        $items = [
                            '0' => 'Без опций',
                            '1' => 'Добавить место + 50%',
                            '2' => 'Добавить завтрак + 10%',
                            '3' => 'Добавить место и завтрак +60%'
                        ];
                        $params = [
                            'prompt' => 'Выберите статус...'
                        ];
                        echo $form->field($room, 'option')->dropDownList($items,$params);?>
                        <?php else:?>
                                <u>Нет опций<u>
                        <?php endif?>
                        <td><?= $room->price?></td>
                        <td><img src="<?php echo '/uploads/'.$room->photo; ?>"  width="180" height="160"></td>
                        <td><?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
                    </tr>
                    <?php ActiveForm::end(); ?>
                <?php endforeach;?>
            </tbody>
        </table>




</div>
