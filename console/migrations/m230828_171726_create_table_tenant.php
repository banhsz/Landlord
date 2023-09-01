<?php

use yii\db\Migration;

/**
 * Class m230828_171726_create_table_tenant
 */
class m230828_171726_create_table_tenant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tenant', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'e_mail' => $this->string(),
            'phone' => $this->string(),
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
        echo "m230828_171726_create_table_tenant cannot be reverted.\n";

        return false;
    }
    */
}
