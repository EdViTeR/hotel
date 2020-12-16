<?php

use yii\db\Migration;

/**
 * Class m201212_115939_room
 */
class m201212_115939_room extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('room', [
            'id' => $this->primaryKey(),
            'number'=>$this->integer(),
            'type'=>$this->string(),
            'quantity'=>$this->integer(),
            'price'=>$this->integer(),
            'free'=>$this->integer(),
            'option'=>$this->integer(),
            'photo'=>$this->string()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('room');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201212_115939_room cannot be reverted.\n";

        return false;
    }
    */
}
