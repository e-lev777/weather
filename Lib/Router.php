<?php
namespace Lib;

use Exception;

abstract class Router
{
    public static $_controller;
    public static $_action;
    public static $module;

    private static $routes = [
        'site' => [
            'default'=> [
                'regex' => '/',
                'controller' => 'Index',
                'action' => 'index',
            ],
            'changeCountry' => [
                'regex' => '/changeCountry.html',
                'controller' => 'Index',
                'action' => 'changeCountry',
            ],
            'changeCity' => [
                'regex' => '/changeCity.html',
                'controller' => 'Index',
                'action' => 'changeCity',
            ],
            'informer' => [
                'regex' => '/informer.html',
                'controller' => 'Informer',
                'action' => 'informer',
            ],
        ],
        'admin' => [
            'adm_default' => [
                'regex' => '/admin',
                'controller' => 'IndexAdm',
                'action' => 'index',
            ],
            'adm_logout' => [
                'regex' => '/admin/logout.html',
                'controller' => 'IndexAdm',
                'action' => 'admLogout',
            ],
            'adm_addSource' => [
                'regex' => '/admin/addSource.html',
                'controller' => 'ADESourceAdm',
                'action' => 'addSource',
            ],
            'adm_deleteSource' => [
                'regex' => '/admin/delete_{id}_source.html',
                'controller' => 'ADESourceAdm',
                'action' => 'deleteSource',
                'params' => [
                    'id' => '[0-9]+',
                ],
            ],
            'adm_editSource' => [
                'regex' => '/admin/edit_{id}_source.html',
                'controller' => 'ADESourceAdm',
                'action' => 'editSource',
                'params' => [
                    'id' => '[0-9]+',
                ],
            ],
            'success' => [
                'regex' => '/admin/success.html',
                'controller' => 'ADESourceAdm',
                'action' => 'success',
            ],
            'fail' => [
                'regex' => '/admin/fail.html',
                'controller' => 'ADESourceAdm',
                'action' => 'fail',
            ],
            'adm_citiesSave' => [
                'regex' => '/admin/citiesSave.html',
                'controller' => 'ADESourceAdm',
                'action' => 'saveCitiesFromXml',
            ],
        ],
    ];

    public static function resolve($url){
        if( strstr($url, '/admin') !== false ){
            Router::$module = 'admin';
        } else {
            Router::$module = 'site';
        }
        foreach (self::$routes[self::$module] as $route ) {
            $regex = $route['regex'];

            if( isset($route['params']) ) {
                foreach ($route['params'] as $k => $v) {
                    $regex = str_replace('{'.$k.'}', "($v)", $regex);
                }
            }
            $regex = "#^{$regex}$#";
            if( preg_match($regex, $url, $matches) ) {
                $params = array();

                array_shift($matches);
                self::$_controller = Router::$module.'\\'.$route['controller'];
                self::$_action = $route['action'];

                if( $matches ){
                    $params = array_combine(array_keys($route['params']), $matches);
                }
                $_GET = $_GET + $params;
            }
        }
        if(!self::$_controller || !self::$_action){
            throw new Exception('Page not found', 404);
        }
    }

    public static function getRoute($module = 'site', $name, $params = []){
        if( !isset(self::$routes[$module][$name]) ){
            return 0;
        }
        $url = self::$routes[$module][$name]['regex'];
        if( isset(self::$routes[$module][$name]['params']) ){
            foreach (self::$routes[$module][$name]['params'] as $k => $v) {
                $url = str_replace('{'.$k.'}', $params[$k], $url);
            }
        }
        return $url;
    }
}