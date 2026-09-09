<?php

class Add_user_names {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $this->_lava->db->raw(
            'ALTER TABLE `users` '
            . 'ADD COLUMN IF NOT EXISTS `firstname` VARCHAR(100) NOT NULL DEFAULT \'\' AFTER `id`, '
            . 'ADD COLUMN IF NOT EXISTS `lastname` VARCHAR(100) NOT NULL DEFAULT \'\' AFTER `firstname`'
        );
    }

    public function down()
    {
        $this->_lava->db->raw(
            'ALTER TABLE `users` '
            . 'DROP COLUMN IF EXISTS `firstname`, '
            . 'DROP COLUMN IF EXISTS `lastname`'
        );
    }
}