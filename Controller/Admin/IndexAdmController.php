<?php
namespace Controller\Admin;

use Lib\Debugger;
use Lib\Router;
use Lib\Controller;
use Lib\Request;
use Lib\MetaHelper;
use Lib\LoginForm;
use Lib\Password;
use Lib\Session;;
use Model\UserModel;
use Model\WeatherModel;

/*
 * Admin start Controller
 */
class IndexAdmController extends Controller
{
    /*
     * Start Action
     * Login Action
     */
    public function indexAction(){
        $_request = new Request();
        $title = MetaHelper::setPageTitle('Главная(admin)');

        $login_form = new LoginForm($_request);
        $errors = array();

        if( $_request->isPost() ){
            if( $login_form->validate() ){

                $user = new UserModel();
                $login = $_request->post('login');
                $hash_password = new Password($_request->post('password'));

                $res = $user->getUser($login, $hash_password);
                if( !$res ){
                    $msg = "No such user";
                } else {
                    Session::set('user', $res);
                    $msg = "You have successfully logged in!";
                }
                Session::setFlash($msg);
            } else {
                $errors = $login_form->showErrors();
            }
        }

        $model = new WeatherModel();
        $data = $model->getSourcelist();

        $args = [
            'errors' =>$errors,
            'data' => $data,
            'page_title' => $title,
        ];
        return $this->render('index.phtml', $args, 'admin');
    }

    /*
     * Logout Action
     */
    public function admLogoutAction(){
        Session::delete('user');
        Session::setFlash('You have logged out!');
        header("Location:  ".Router::getRoute('admin', 'adm_default'));
    }
}