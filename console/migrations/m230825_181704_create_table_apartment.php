<?php

use yii\db\Migration;

/**
 * Class m230825_181704_create_table_apartment
 */
class m230825_181704_create_table_apartment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apartment', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
            'rent' => $this->integer(),
            'rooms' => $this->integer(),
            'is_smoking' => $this->boolean(),
            'is_animal_allowed' => $this->boolean(),
            'is_parking_spot' => $this->boolean(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apartment');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230825_181704_create_table_apartment cannot be reverted.\n";

        return false;
    }
    */
}
