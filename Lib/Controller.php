<?php

namespace Lib;

use Exception;

abstract class Controller
{
    protected function render($viewName, $args = [], $AdminSwitch = '')
    {
        $className = get_class($this);
        $className = str_replace('Controller', '', $className);
        $Path = VIEW_DIR . $className . DS . $viewName;
        $adminPath = VIEW_DIR . $className . DS . $viewName;

        if ( $AdminSwitch != 'admin' ) {
            if (file_exists($Path)) {
                ob_start();
                    require $Path;
                $data = ob_get_clean();

                ob_start();
                    require VIEW_DIR . "layout.phtml";
                return ob_get_clean();
            } else {
                throw new Exception("{$Path} not found");
            }
        } elseif( $AdminSwitch == 'admin') {
            if ( file_exists($adminPath) ) {
                ob_start();
                    require $adminPath;
                $data = ob_get_clean();

                ob_start();
                    require VIEW_DIR . "adminLayout.phtml";
                return ob_get_clean();
            } else {
                throw new Exception("{$adminPath} not found");
            }
        }
    }

    public static function renderAsideMenu(){
//        $item = $model->getMenuList();
        $menu = new AsideMenu();

        ob_start();
            require VIEW_DIR.'asideMenu.phtml';
        return ob_get_clean();
    }

    public static function renderError($code, $message){
        ob_start();
            require VIEW_DIR.'error.phtml';
        $data = ob_get_clean();

        ob_start();
            require VIEW_DIR."layout.phtml";
        return ob_get_clean();
    }

    protected function weatherRender($viewName, $args = [], $AdminSwitch = '')
    {
        $className = get_class($this);
        $className = str_replace('Controller', '', $className);
        $Path = VIEW_DIR . $className . DS . $viewName;
        $adminPath = VIEW_DIR . $className . DS . $viewName;

        if ( $AdminSwitch != 'admin' ) {
            if (file_exists($Path)) {
                ob_start();
                    require $Path;
                return ob_get_clean();

            } else {
                throw new Exception("{$Path} not found");
            }
        } elseif( $AdminSwitch == 'admin' ) {
            if ( file_exists($adminPath) ) {
                ob_start();
                    require $adminPath;
                return ob_get_clean();

            } else {
                throw new Exception("{$adminPath} not found");
            }
        }
    }
}