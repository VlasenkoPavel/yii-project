<?php

use yii\db\Migration;

class m180304_124325_create_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(),
            'username' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
            'password' => $this->string(255)->notNull(),
            'access_token' => $this->string()->notNull(),
            'email' => $this->string(100)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function down() {
        $this->dropTable('user');
    }
}
