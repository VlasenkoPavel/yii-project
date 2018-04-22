<?php

use yii\db\Migration;

class m180419_194808_add_roles extends Migration
{
    public function up()
    {
        $this->insert('role', [
            'name' => 'superuser',
            'access_level' => 0
        ]);

        $this->insert('role', [
            'name' => 'admin',
            'access_level' => 1
        ]);

        $this->insert('role', [
            'name' => 'grouphead',
            'access_level' => 3
        ]);

        $this->insert('role', [
            'name' => 'employer',
            'access_level' => 5
        ]);

        $this->addForeignKey(
            'user_roleId_fk',
            'user',
            'role_id',
            'role',
            'id'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'user_roleId_fk',
            'user'
        );

        $this->delete('role', ['name' => 'superuser']);
        $this->delete('role', ['name' => 'admin']);
        $this->delete('role', ['name' => 'grouphead']);
        $this->delete('role', ['name' => 'employer']);
    }
}
