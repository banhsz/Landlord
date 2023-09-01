<?php

use yii\db\Migration;

/**
 * Class m230825_205621_add_column_image_to_apartment_table
 */
class m230825_205621_add_column_image_to_apartment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('apartment', 'image_path', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('apartment', 'image_path');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230825_205621_add_column_image_to_apartment_table cannot be reverted.\n";

        return false;
    }
    */
}
