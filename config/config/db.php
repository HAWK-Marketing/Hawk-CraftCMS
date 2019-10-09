<?php
/**
 * Database Configuration
 *
 * All of your system's database connection settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/DbConfig.php.
 *
 * @see craft\config\DbConfig
 */

use Platformsh\ConfigReader\Config;

$config = new Config();

if ($config->isValidPlatform()) {
    if ($config->hasRelationship('database')) {
        $database = $config->credentials('database');

        return [
            'driver' => $database['scheme'],
            'server' => $database['host'],
            'user' => $database['username'],
            'password' => $database['password'],
            'database' => $database['path'],
            'schema' => '',
            'tablePrefix' => getenv('DB_TABLE_PREFIX'),
            'port' => $database['port'],
        ];
    }
}

return [
    'driver' => getenv('DB_DRIVER'),
    'server' => getenv('DB_SERVER'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'database' => getenv('DB_DATABASE'),
    'schema' => getenv('DB_SCHEMA'),
    'tablePrefix' => getenv('DB_TABLE_PREFIX'),
    'port' => getenv('DB_PORT')
];