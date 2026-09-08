<?php

class Seed_admin_user {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
    }

    public function up()
    {
        $password = getenv('ADMIN_PASSWORD');
        if (!$password) {
            return;
        }

        $this->_lava->call->model('UsersModel');
        if (UsersModel::count() > 0) {
            return;
        }

        UsersModel::insert([
            'username' => getenv('ADMIN_USERNAME') ?: 'admin',
            'email' => getenv('ADMIN_EMAIL') ?: 'admin@example.com',
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_active' => 1,
        ]);
    }

    public function down()
    {
        // Keep seeded users intact when rolling back unrelated migrations.
    }
}