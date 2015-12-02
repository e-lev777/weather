<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__.DS);
define("VIEW_DIR", ROOT."View");
define("ADMIN_VIEW_DIR", ROOT."View".DS."Admin".DS);
define("CONTROLLER_DIR", ROOT."Controller".DS);
define("ADMIN_CONTROLLER_DIR", ROOT."Controller".DS."Admin".DS);
define("LIB_DIR", ROOT."Lib".DS);
define("MODEL_DIR", ROOT."Model".DS);

$for_pdo_exception = array(
    'email' => 'admin@gmail.com',
    'subject' => 'PDO Error',
);

//data source name
$dsn = 'mysql:host=localhost; dbname=weather';
//user
$user = 'root';
//pass
$password = '';