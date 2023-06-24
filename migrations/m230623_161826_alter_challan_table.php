<?php

use app\models\Challan;
use yii\db\Migration;

/**
 * Class m230623_161826_alter_challan_table
 */
class m230623_161826_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Challan::tableName(),'add_group_id',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230623_161826_alter_challan_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230623_161826_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
