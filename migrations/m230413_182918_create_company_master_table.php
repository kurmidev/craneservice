<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_master}}`.
 */
class m230413_182918_create_company_master_table extends Migration
{

    public $table = "company_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=>$this->string(250)->notNull()->unique(),
            "mobile_no"=>$this->string(12)->notNull(),
            "phone_no"=> $this->string(15),
            "email"=>$this->string(150),
            "billing_address"=>$this->string(250),
            "city_id"=>$this->integer(),
            "pincode"=>$this->integer(),
            "gst_in"=> $this->string(100),
            "pan_no"=>$this->string(10),
            "supply_place"=>$this->string(200),
            "state_code" => $this->integer(),
            "status"=>$this->integer(1)->notNull()->defaultValue(1),
            "created_at"=>$this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by"=>$this->integer(),
            "updated_at"=>$this->dateTime(),
            "updated_by"=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
