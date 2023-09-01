<?php

use yii\db\Migration;

/**
 * Class m230828_184403_create_table_rental
 */
class m230828_184403_create_table_rental extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rental', [
            'id' => $this->primaryKey(),
            'apartment_id' => $this->integer(),
            'tenant_id' => $this->integer(),
            'rent_start' => $this->integer(),
            'rent_end' => $this->integer(),
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
        $this->dropTable('tenant');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230828_184403_create_table_rental cannot be reverted.\n";

        return false;
    }
    */
}
