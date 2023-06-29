<?php

use app\models\VehicleMaster;
use yii\db\Migration;

/**
 * Class m230629_163819_alter_vehicle_master_table
 */
class m230629_163819_alter_vehicle_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(VehicleMaster::tableName(), 'start_date', $this->integer());
        $this->alterColumn(VehicleMaster::tableName(), 'end_date', $this->integer());
        $this->addColumn(VehicleMaster::tableName(), 'serial_applicable', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230629_163819_alter_vehicle_master_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230629_163819_alter_vehicle_master_table cannot be reverted.\n";

        return false;
    }
    */
}
