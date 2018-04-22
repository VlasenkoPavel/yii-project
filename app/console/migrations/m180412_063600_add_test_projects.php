<?php

use yii\db\Migration;


class m180412_063600_add_test_projects extends Migration
{

//'username' => 'admin',
//'name' => 'Pavel',
//'surname' => 'Vlasenko',
//'password' => password_hash('001qwe', PASSWORD_DEFAULT),
//'email' => 'admin-email.ru',
//'access_token' => \Yii::$app->security->generateRandomString(),
//'created_at' => date('Y-m-d G:i:s')

    public function up()
    {
        $this->insert('project', [
            'name' => 'adminProj',
            'description' => 'this is admins project',
            'creator_id' => 1,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('project', [
            'name' => 'ivanProj1',
            'description' => 'this is Ivans project №1',
            'creator_id' => 2,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('project', [
            'name' => 'ivanProj2',
            'description' => 'this is Ivans project №2',
            'creator_id' => 2,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

    }

    public function down()
    {
        $this->delete('project', ['name' => 'adminProj']);
        $this->delete('project', ['name' => 'ivanProj1']);
        $this->delete('project', ['name' => 'ivanProj2']);
    }
}
