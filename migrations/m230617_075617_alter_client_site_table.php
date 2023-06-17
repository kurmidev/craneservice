<?php

use app\models\ClientSite;
use yii\db\Migration;

/**
 * Class m230617_075617_alter_client_site_table
 */
class m230617_075617_alter_client_site_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(ClientSite::tableName(),'is_default',$this->integer()->notNull()->defaultValue(0));
        $this->addColumn(ClientSite::tableName(),'site_city_id',$this->integer()->null());
        $this->addColumn(ClientSite::tableName(),'site_pincode',$this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230617_075617_alter_client_site_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230617_075617_alter_client_site_table cannot be reverted.\n";

        return false;
    }
    */
}
