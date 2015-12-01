<?php

namespace Model;

use Lib\Registry;
use PDO;

/*
 * Yandex weather model
 */

class WeatherModel
{
    /*
     * Yandex forecast
     */
    public function getXmlYandexForecast(){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT weather_source FROM sources WHERE source_name = :source_name");
        $params = [
            'source_name' => 'yandex'
        ];
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Yandex Cities
     */
    public function getXmlYandexCities(){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT cities_source FROM sources WHERE source_name = :source_name");
        $params = [
            'source_name' => 'yandex'
        ];
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Yandex default values
     */
    public function getDefaultYandexValues(){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT default_value FROM sources WHERE source_name = :source_name");
        $params = [
            'source_name' => 'yandex'
        ];
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Sources list (for admin panel)
     */
    public function getSourcelist(){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT * FROM sources");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * Adding new source (for admin panel)
     */
    public function addNewSource($source_name, $weather_source, $cities_source = '', $default_value = ''){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("INSERT INTO sources (source_name, weather_source, cities_source, default_value)
                              VALUES (:source_name, :weather_source, :cities_source, :default_value)");
        $params = [
            'source_name' => $source_name,
            'weather_source' => $weather_source,
            'cities_source' => $cities_source,
            'default_value' => (int)$default_value,
        ];
        $sth->execute($params);
        return true;
    }

    /*
     * Editing source (for admin panel)
     */
    public function updateSource($source_id, $source_name, $weather_source, $cities_source = '', $default_value = ''){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("UPDATE sources SET source_name = :source_name,
                                                 weather_source = :weather_source,
                                                 cities_source = :cities_source,
                                                 default_value = :default_value
                                                 WHERE id = :id");
        $params = [
            'source_name' => $source_name,
            'weather_source' => $weather_source,
            'cities_source' => $cities_source,
            'default_value' => (int)$default_value,
            'id' => (int)$source_id,
        ];
        $sth->execute($params);
        return true;
    }

    /*
     * Source deleting
     */
    public function deleteSource($source_id){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("DELETE FROM sources WHERE id = :id");
        $params = [
            'id' => (int)$source_id,
        ];
        $sth->execute($params);
        return true;
    }

    /*
     * Source getter by ID
     */
    public function getSource($source_id){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT * FROM sources WHERE id = :id");
        $params = [
            'id' => (int)$source_id,
        ];
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Informer data
     */
    public function getInformerData(){
        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT content FROM informer");

        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}