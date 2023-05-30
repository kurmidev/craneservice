<?php

use app\models\Challan;
use yii\db\Migration;

/**
 * Class m230530_153003_alter_challan_table
 */
class m230530_153003_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try{
            $this->addColumn(Challan::tableName(),"client_type",$this->integer()->notNull()->defaultValue("0"));
        }catch(Exception $ex){
            return true;
        }

        $query = 'update challan c inner join client_master m on c.client_id=m.id set c.client_type=m.client_type';
        Yii::$app->db->createCommand($query)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230530_153003_alter_challan_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230530_153003_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
