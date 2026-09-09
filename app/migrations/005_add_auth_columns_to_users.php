<?php

class Add_auth_columns_to_users
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('users')) {
            return;
        }

        $columns = [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => TRUE,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => "'admin','user'",
                'null'       => FALSE,
                'default'    => 'user',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => TRUE,
                'null'       => FALSE,
                'default'    => 1,
            ],
        ];

        foreach ($columns as $name => $definition) {
            if (!$this->_lava->dbforge->column_exists('users', $name)) {
                $this->_lava->dbforge->add_column('users', [$name => $definition]);
            }
        }
    }

    public function down()
    {
        foreach (['is_active', 'role', 'password'] as $column) {
            if ($this->_lava->dbforge->column_exists('users', $column)) {
                $this->_lava->dbforge->drop_column('users', $column);
            }
        }
    }
}
