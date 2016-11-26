<?php
// locally: use standard settings
$mysql = [
   'driver' => 'mysql',
   'host' => env('DB_HOST', 'localhost'),
   'port' => env('DB_PORT', '3306'),
   'database' => env('DB_DATABASE', 'forge'),
   'username' => env('DB_USERNAME', 'forge'),
   'password' => env('DB_PASSWORD', ''),
   'charset' => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix' => '',
   'strict' => true,
   'engine' => null,
];


// on fortrabbit: construct credentials from App secrets
if (isset($_SERVER['APP_SECRETS'])) {
   $secrets = json_decode(file_get_contents($_SERVER['APP_SECRETS']), true);
   $mysql = [
      'driver'    => 'mysql',
      'host'      => $secrets['MYSQL']['HOST'],
      'port'      => $secrets['MYSQL']['PORT'],
      'database'  => $secrets['MYSQL']['DATABASE'],
      'username'  => $secrets['MYSQL']['USER'],
      'password'  => $secrets['MYSQL']['PASSWORD'],
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
      'strict'    => false,
   ];
}

return [
   'fetch'         => PDO::FETCH_OBJ,
   'default'       => env('DB_CONNECTION', 'mysql'),
   'connections'   => [
      'mysql' => $mysql,
   ],
   'migrations' => 'migrations'
   // possible other code …
];
