<?php
namespace Controller\Site;

use Lib\Controller;
use Lib\Cookie;
use Lib\Debugger;
use Lib\MetaHelper;
use Model\WeatherModel;
use Lib\Weather;
use Lib\Request;
/*
 * Starting Controller
*/

class IndexController extends Controller
{
    /*
     * Starting Action
     */
    public function indexAction()
    {
        $msg ='';
        $title = MetaHelper::setPageTitle('Погода');
        $request = new Request();
        $model = new WeatherModel();

        /*
         * Getting Yandex weather data xml file
         * Getting default values
         */
        $yandex_xml = $model->getXmlYandexForecast();
        $yandex_default_values = $model->getDefaultYandexValues();

        if( $request->isPost() ){
            if( $request->post('submit') ){
                $result = $model->searchByCityName($request->post('city_search'));
                if( $result ){
                    $city_id = $result['city_id'];
                } else {
                    $city_id = $yandex_default_values['default_value'];
                    $msg = 'Город не найден в списке';
                }
            }
        } else {
            $city_id = Cookie::get('city_id') ? Cookie::get('city_id') : $yandex_default_values['default_value'];
        }

        /*
         * Yandex xml data parsing
         */
        $weather = new Weather($yandex_xml['weather_source'], $city_id);
        $data = $weather->xmlProcessing();
        $city_name = array_shift($data);

        /*
         * Getting Yandex cities data
         */
        $yandex_cities_xml = $model->getXmlYandexCities();
        $countries = simplexml_load_file($yandex_cities_xml['cities_source'].'.xml');

        /*
         * Getting Yandex data informer
         */
        $informer = $model->getInformerData();

        $args = [
            'page_title' => $title,
            'data' => $data,
            'countries' => $countries,
            'city_name' => $city_name,
            'informer' => $informer,
            'msg' => $msg,
        ];

        /*
         * Rendering starting page
         */
        return $this->render("index.phtml", $args);
    }

    /*
     * Country change Action
     * Getting countries list
     */
    public function changeCountryAction(){
        $request = new Request();
        $model = new WeatherModel();

        $country_list = $model->getXmlYandexCities();
        $data = Weather::changeCountries($request->post('country_name'), $country_list['cities_source']);

        return $data;
    }

    /*
     * City change Action
     * Getting cities list
     */
    public function changeCityAction(){
        $request = new Request();
        $model = new WeatherModel();


        $yandex_xml = $model->getXmlYandexForecast();
        $city_id = $request->post('city_id');


        /*
         * Getting weather report for city
         */
        $weather = new Weather($yandex_xml['weather_source'], $city_id);
        $data = $weather->xmlProcessing();
        $city_name = array_shift($data);

        $args = [
            'data' => $data,
            'city_name' => $city_name,
        ];

        /*
         * Rendering page with city
         */
        return $this->weatherRender('result.phtml', $args);
    }
}