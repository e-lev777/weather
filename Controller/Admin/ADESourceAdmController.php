<?php

namespace Controller\Admin;

use Lib\Controller;
use Lib\MetaHelper;
use Lib\Request;
use Lib\Session;
use Model\WeatherModel;
use Lib\Router;

/*
 * Add, delete, edit sources Controller
 */

class ADESourceAdmController extends Controller
{
    /*
     * Add source Action
     */
    public function addSourceAction(){
        $title = MetaHelper::setPageTitle('Добавить источник');
        $request = new Request();
        $model = new WeatherModel();

        if( $request->post('addNewSource') ){
            $model->addNewSource($request->post('source_name'),
                                 $request->post('source_weather_file'),
                                 $request->post('source_cities_file'),
                                 $request->post('source_default_value'));
        }

        $args = [
            'page_title' => $title,
        ];
        return $this->render('addSource.phtml', $args, 'admin');
    }

    /*
     * Delete source Action
     */
    public function deleteSourceAction(){
        $request = new Request();
        $model = new WeatherModel();
        $model->deleteSource($request->get('id'));

        header("Location:  ".Router::getRoute('admin', 'adm_default'));
    }

    /*
     * Edit source Action
     */
    public function editSourceAction(){
        $title = MetaHelper::setPageTitle('Редактировать источник');
        $model = new WeatherModel();
        $request = new Request();

        $data = $model->getSource($request->get('id'));

        if( $request->post('editSource') ){
            $action = $model->updateSource($request->get('id'),
                                 $request->post('source_name'),
                                 $request->post('source_weather_file'),
                                 $request->post('source_cities_file'),
                                 $request->post('source_default_value'));

            if( $action == true ){
                header("Location:  ".Router::getRoute('admin', 'success'));
            } else {
                header("Location:  ".Router::getRoute('admin', 'fail'));
            }

        }

        $args = [
            'page_title' => $title,
            'data' => $data,
            'msg' => isset($msg)?$msg:null,
        ];
        return $this->render('editSource.phtml', $args, 'admin');
    }

    /*
     * Success edit page Action
     */
    public function successAction(){
        $title = MetaHelper::setPageTitle('Успешно отредактировано');

        $args = [
            'page_title' => $title
        ];
        return $this->render('success.phtml', $args, 'admin');
    }

    /*
     * Fail edit page Action
     */
    public function failAction(){
        $title = MetaHelper::setPageTitle('Ошибка');

        $args = [
            'page_title' => $title
        ];
        return $this->render('fail.phtml', $args, 'admin');
    }
}