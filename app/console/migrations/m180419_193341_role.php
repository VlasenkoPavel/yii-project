<?php

use yii\db\Migration;

class m180419_193341_role extends Migration
{
    public function up()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'access_level' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable("role");
    }
}
