<?php
namespace weather;

use weather\AbstractWeather;

//use DOMDocument;


class WeatherXml extends AbstractWeather
{
    
    public $dataRequest = [
        
        'Скорость ветра в км' => 'windspeedKmph',
        'Градус ветра' => 'windspeedKmph',
        'Температура по Фаренгейту' => 'temp_F',
        'Ощущение' =>  'FeelsLikeF'
        
    ];
    
      
    
    public function normalizeData(){
        
        $dataXml = simplexml_load_string($this->dataWeatherReply);
        
        
        foreach ($this->dataRequest as $term => $value) {
            
            $dataGroup = 'current_condition';
            $dataValue = $dataXml->$dataGroup->$value;
            
            $this->dataWeather[] = array($value => $dataValue);
            
        }
    }
    
    
    
    public function recordToFile () {
        
        $xml = simplexml_load_file('data.xml');
        
        $group = $xml->addChild('dataWeather');
        
        foreach ($this->dataWeather as $val) {
            foreach ($val as $key => $value) {
                $group->addChild($key , $value);
            }
        }
        
        $xml->asXML('data.xml');
        
        
    }
    
    public function showWeather() {
        $open = file_get_contents('data.xml');
        $show = simplexml_load_string($open);
        unset ($open);
        
        //var_dump($show);
        foreach ($show as $val) {
            foreach ($val as $term => $value1) {
                echo $term .' : ' . $value1 . ';<br>';
            }      
        }
    }
    
    
    public function __construct()
    {
        parent::__construct();
    }
    
}

//$test1 = new WeatherXml();