<?php

use yii\db\Migration;

/**
 * Class m201212_173702_reserve_room
 */
class m201212_173702_reserve_room extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reserve_room', [
            'id' => $this->primaryKey(),
            'room_id'=>$this->integer(),
            'price'=>$this->integer(),
            'date_arrival'=>$this->date(),
            'date_departure'=>$this->date(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-room_id',
            'reserve_room',
            'room_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-room_id',
            'reserve_room',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201212_173702_reserve_room cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201212_173702_reserve_room cannot be reverted.\n";

        return false;
    }
    */
}
