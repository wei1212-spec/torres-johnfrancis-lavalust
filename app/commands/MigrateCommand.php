<?php

class MigrateCommand {

    public static $command = 'db:migrate';
    public static $description = 'Run pending database migrations';
    public static $arguments = [];

    public function handle()
    {
        putenv('MIGRATIONS_ENABLED=true');
        $GLOBALS['argv'][1] = '/';

        $root_dir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;
        if (!defined('ROOT_DIR')) {
            define('ROOT_DIR', $root_dir);
        }
        if (!defined('SYSTEM_DIR')) {
            define('SYSTEM_DIR', $root_dir . 'scheme' . DIRECTORY_SEPARATOR);
        }
        if (!defined('PREVENT_DIRECT_ACCESS')) {
            define('PREVENT_DIRECT_ACCESS', true);
        }

        ob_start();
        require_once $root_dir . 'scheme/kernel/LavaLust.php';
        ob_end_clean();

        $migration = load_class('migration', 'libraries');
        $migration->migrate();
    }
}