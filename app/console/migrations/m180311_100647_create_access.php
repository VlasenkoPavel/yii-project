<?php

use yii\db\Migration;

/**
 * Class m180311_100647_createaccess
 */
class m180311_100647_create_access extends Migration
{
    public function up()
    {
        $this->createTable('access', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'fk_access_1_idx',
            'access',
            'task_id'
        );

        $this->createIndex(
            'fk_access_2_idx',
            'access',
            'user_id'
        );
    }

    public function down() {
        $this->dropTable('access');
    }
}
