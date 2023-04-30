<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_site}}`.
 */
class m230429_161614_create_client_site_table extends Migration
{

    public $table = "client_site";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "address"=> $this->string()->notNull(),
            "client_id" =>  $this->integer()->notNull(),
            "status" => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,'client_id',"client_master",'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
