<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int|null $number
 * @property string|null $type
 * @property int|null $quantity
 * @property int|null $price
 * @property int|null $free
 * @property int|null $option
 * @property string|null $photo
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'quantity', 'price', 'free', 'option'], 'integer'],
            [['type', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'type' => 'Type',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'free' => 'Free',
            'option' => 'Option',
            'photo' => 'Photo',
        ];
    }

    public function saveImage($filename)
    {
        $this->photo = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        if ($this->photo){
            return '/uploads/' . $this->image;
        }
        return '/no-image.png';
    }
}
