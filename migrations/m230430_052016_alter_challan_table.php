<?php

use yii\db\Migration;

/**
 * Class m230430_052016_alter_challan_table
 */
class m230430_052016_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("challan","extra", $this->money()->notNull()->defaultValue(0));
        $this->addColumn("challan","tax", $this->money()->notNull()->defaultValue(0));
        $this->addColumn("challan","total", $this->money()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230430_052016_alter_challan_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230430_052016_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
