<?php

class Normalize_users_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        $has_users = $this->_lava->dbforge->table_exists('users');
        $has_user  = $this->_lava->dbforge->table_exists('user');

        if (!$has_users && $has_user) {
            $this->_lava->db->raw('RENAME TABLE `user` TO `users`');
            return;
        }

        if ($has_users && $has_user) {
            $this->_lava->db->raw(
                'INSERT IGNORE INTO `users` '
                . '(`id`, `username`, `email`, `password`, `role`, `is_active`) '
                . 'SELECT `id`, `username`, `email`, `password`, `role`, `is_active` '
                . 'FROM `user`'
            );
        }
    }

    public function down()
    {
        $has_users = $this->_lava->dbforge->table_exists('users');
        $has_user  = $this->_lava->dbforge->table_exists('user');

        if ($has_users && !$has_user) {
            $this->_lava->db->raw('RENAME TABLE `users` TO `user`');
        }
    }
}