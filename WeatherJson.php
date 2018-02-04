<?php
namespace weather;

use weather\AbstractWeather;

class WeatherJson extends AbstractWeather
{
    public $dataRequest = [
        
        'Дата' => ['time_zone', 'localtime'],
        'Температура по Цельсию' => 'temp_C',
        'Ощущение' =>  'FeelsLikeC',
        'Направление ветра' => 'winddir16Point',
        'Скорость ветра в км' => 'windspeedKmph'
        
    ];
    
    public function openFile () {
        
        $file = file_get_contents('data.json');  
        $this->dataWeather = json_decode($file,TRUE);  
        unset($file);
        
    }
    
    
    public function normalizeData(){
        
        $dataJson=json_decode($this->dataWeatherReply);
        
        
        foreach ($this->dataRequest as $term => $value) {
            
            if (is_array($value)){
                $dataGroup = $value[0];
                $dataValue = $dataJson->{'data'}->{$value[0]}[0]->{$value[1]};
                //$dataValue = $dataJson->{'data'}->{'time_zone'}[0]->{'localtime'};
            }
            else {
                $dataGroup = 'current_condition';
                $dataValue = $dataJson->{'data'}->{$dataGroup}[0]->{$value};
            }
            
            //echo $term .' : ' . $dataValue . ';<br>';
            $this->dataWeather[] = array($term => $dataValue);
            
        }
    }
    
    
    public function recordToFile () {
        file_put_contents ('data.json', json_encode($this->dataWeather));
        
    }
    
    public function showWeather() {
        $open = file_get_contents('data.json');
        $show = json_decode($open, TRUE);
        unset ($open);
        
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


//$test1 = new WeatherJson();

