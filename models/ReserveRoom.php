<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserve_room".
 *
 * @property int $id
 * @property int|null $room_id
 * @property int|null $price
 * @property string|null $date_arrival
 * @property string|null $date_departure
 *
 * @property Room $room
 */
class ReserveRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'price'], 'integer'],
            [['date_arrival', 'date_departure'], 'safe'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'price' => 'Price',
            'date_arrival' => 'Date Arrival',
            'date_departure' => 'Date Departure',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
