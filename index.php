<?php
require ("config.php");

use Lib\Session;
use Lib\Registry;
use Lib\Router;
use Lib\Controller;
use Lib\Debugger;

Session::start();


$url = explode('?', $_SERVER['REQUEST_URI']);
$url = $url[0];

//функуия автозагрузки
function __autoload($classname)
{
    $classFile = str_replace('\\', '/', $classname);
    if (file_exists(ROOT . $classFile . '.php')) {
        require ROOT . $classFile . '.php';
    } else {
        throw new Exception("{$classFile} not found");
    }
}

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    Registry::set('dbh', $dbh);

    Router::resolve($url);
    $_controller = Router::$_controller;
    $_action = Router::$_action;


    $_controller = 'Controller\\'.ucfirst($_controller)."Controller";
    $_action .= "Action";

    $_controller = new $_controller();

    if (method_exists($_controller, $_action)) {
        $content = $_controller->$_action();
    } else {
        throw new Exception("{$_action} not found");
    }
}
catch (PDOException $e){
    $to = $for_pdo_exception['email'];
    $subject = $for_pdo_exception['subject'];
    $message = $e->getMessage();

    mail($to, $subject, $message);
    $content = Controller::renderError(500, 'Server error');

} catch (Exception $e){
    $content = Controller::renderError($e->getCode(), $e->getMessage());
}
echo $content;