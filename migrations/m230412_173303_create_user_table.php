<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230412_173303_create_user_table extends Migration
{

    protected $table = "user";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=>$this->string(250)->notNull(),
            "username"=>$this->string(250)->unique()->notNull(),
            "password"=>$this->string(250)->notNull(),
            "password_hash"=>$this->string(250)->notNull(),
            "auth_key"=>$this->string(250)->notNull(),
            "password_reset_token"=>$this->string(250)->null(),
            "designation_id"=>$this->integer(),
            "status"=>$this->integer(1)->notNull()->defaultValue(1),
            "last_login_at"=>$this->dateTime(),
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
