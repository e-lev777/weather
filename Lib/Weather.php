<?php

namespace Lib;

/*
* Yandex weather API
*/
class Weather
{
    public $xmlData;

    public $daysLimit = 10;

    public $days = [
        'city_name' => '',
    ];

    public $weekDays = [
        1 => 'пн',
        2 => 'вт',
        3 => 'ср',
        4 => 'чт',
        5 => 'пт',
        6 => 'сб',
        7 => 'вс',
    ];

    public $dayParts = [
        0 => 'утро',
        1 => 'день',
        2 => 'вечер',
        3 => 'ночь',
    ];

    public $weather_data = [];

    public function __construct($yandex_xml, $city_id = 33487){
        $this->xmlData = simplexml_load_file($yandex_xml.$city_id.'.xml');
    }

    public function getXml(){
        return isset($this->xmlData) ? $this->xmlData : false;
    }

    /*
     * Yandex xml parse method
     */
    public function xmlProcessing(){
        $dayCounter = 0;
        $weekDayCounter = date('N');
        $this->days['city_name'] = $this->xmlData['city'];

        foreach ($this->xmlData->day as $day) {
            if( $dayCounter == $this->daysLimit ){
                break;
            }

            if( $weekDayCounter == count($this->weekDays)+1 ){
                $weekDayCounter = 1;
            }
            $this->days[$dayCounter]['date'] = date('d-m-Y', strtotime($day['date']));
            $this->days[$dayCounter]['week_day'] = $this->weekDays[$weekDayCounter];

            for($i=0; $i<4; $i++) {

                $this->days[$dayCounter]['weather'][$i]['time'] = $this->dayParts[$i];
                $this->days[$dayCounter]['weather'][$i]['image'] = "<img src=http://yandex.st/weather/1.1.78/i/icons/48x48/".$day->day_part[$i]->{'image-v3'}.".png width='48' height='48'>";

                if( $day->day_part[$i]->temperature == '' ) {

                    $this->days[$dayCounter]['weather'][$i]['temperature_from'] = $day->day_part[$i]->temperature_from > 0 ?
                        '+'.$day->day_part[$i]->temperature_from : $day->day_part[$i]->temperature_from;

                    $this->days[$dayCounter]['weather'][$i]['temperature_to'] = $day->day_part[$i]->temperature_to > 0 ?
                        '+'.$day->day_part[$i]->temperature_to : $day->day_part[$i]->temperature_to;

                } else {
                    $this->days[$dayCounter]['weather'][$i]['temperature'] = $day->day_part[$i]->temperature > 0 ?
                        '+'.$day->day_part[$i]->temperature : $day->day_part[$i]->temperature;
                }
            }
            $weekDayCounter++;
            $dayCounter++;
        }
        return $this->days;
    }

    /*
     * Yandex weather data getter
     */
    public function getWeatherData(){
        return isset($this->weather_data) ? $this->weather_data : null;
    }

    /*
     * Countries and cities change mathod
     * Creates dynamic select option
     */
    public static function changeCountries($country_name, $country_xml){
        $cities = '<option value="0">--Выберете город--</option>';

        if( $country_name != '0' ){
            $xml_cities_data = simplexml_load_file($country_xml.".xml");

            if( !$xml_cities_data ){
                return 'Не удалось загрузить данные по городам';
            } else {
                foreach($xml_cities_data->country as $country ){
                    if( $country['name'] == $country_name ){
                        foreach($country->city as $city){
                            $cities .= "<option value='{$city['id']}'>{$city}</option>";
                        }
                    }
                }
            }
        }
        return $cities;
    }
}