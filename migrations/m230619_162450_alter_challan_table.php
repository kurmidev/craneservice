<?php

use app\models\Challan;
use yii\db\Migration;

/**
 * Class m230619_162450_alter_challan_table
 */
class m230619_162450_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Challan::tableName(),'plan_type',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230619_162450_alter_challan_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230619_162450_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
