<?php
namespace weather;

use weather\WeatherJson;
use weather\WeatherXml;


abstract class AbstractWeather 
{
    
    public $dataWeatherReply; //полученные данные из API погоды   
    public $arrayRequest; // массив необходимых данных погоды
    public $dataWeather; // преобразованные в массив необходимые данные погоды
        
    public function requestWeatherData() {
        
        $basicUrl=sprintf('http://api.worldweatheronline.com/premium/v1/weather.ashx?key=%s&q=%s&num_of_days=%s&format=%s&fx=%s&mca=%s&fx24=%s&showlocaltime=%s&lang=%s',
            API_KEY, LOCATION, NUM_OF_DAYS, 
            FORMAT, FX, MCA, FX24, 
            SHOW_LOCAL_TIME, LANG);
        
        $this->dataWeatherReply = file_get_contents($basicUrl);
        
        //$testXml = simplexml_load_string($this->dataWeatherReply);
        
        //var_dump ($testXml);
        //print $basicUrl . "<br />\n";
        
        
    }
    
    public function openFile() {
        
    }
    
    public function normalizeData(){
        
    }
    
    public function recordToFile() {
        
    }
    
    public function showWeather() {
        
    }
    
    public function __construct()
    {
        $this->requestWeatherData();
        $this->openFile();
        $this->normalizeData();
        $this->recordToFile();
        $this->showWeather();
        
    }
    
    public static function getFactory()
    {
        switch (FORMAT) {
            case 'json':
                return new WeatherJson();
            case 'xml':
                return new WeatherXml();
        }
        throw new Exception('unknown format');
    }
}

//$abstractWeather1 = new AbstractWeather;
//$abstractWeather1->requestWeatherData();
