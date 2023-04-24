<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vendor}}`.
 */
class m230414_103944_create_vendor_table extends Migration
{

    public $table = "client_master";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_type" => $this->integer(1),
            "company_id" => $this->integer()->notNull(),
            "company_name" => $this->string(250),
            "first_name" => $this->string(150)->notNull(),
            "last_name" => $this->string(150)->notNull(),
            "email" =>  $this->string(250),
            "mobile_no" => $this->string(10),
            "phone_no" => $this->string(15),
            "address" => $this->string(),
            "city_id" => $this->integer(),
            "pincode" => $this->string(),
            "site_address" => $this->string(),
            "site_city_id" => $this->integer(),
            "site_pincode" => $this->string(),
            "type" => $this->integer(),
            "status" => $this->integer()->defaultValue(1),
            "created_at" => $this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by" => $this->integer(),
            "updated_at" => $this->dateTime(),
            "updated_by" => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-company_id",$this->table,'company_id','company_master','id');
        $this->addForeignKey("fk-{$this->table}-city_id",$this->table,'city_id','city','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
