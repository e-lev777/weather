<?php

namespace Controller\Site;


use Lib\Controller;
use Lib\MetaHelper;
use Model\WeatherModel;
use Lib\Cookie;
use Lib\Weather;

/*
 * Informer Controller
 */
class InformerController extends Controller
{
    public function informerAction(){
        $model = new WeatherModel();

        $yandex_xml = $model->getXmlYandexForecast();
        $yandex_default_values = $model->getDefaultYandexValues();
        $default_value = Cookie::get('city_id') ? Cookie::get('city_id') : $yandex_default_values['default_value'];

        $weather = new Weather($yandex_xml['weather_source'], $default_value);
        $data = $weather->xmlProcessing();
        $city_name = array_shift($data);

        $args = [
            'data' => $data,
            'city_name' => $city_name,
        ];

        return $this->weatherRender('informer.phtml', $args);
    }
}