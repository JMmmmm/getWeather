<?php

use weather\AbstractWeather;

include_once 'AbstractWeather.php';
include_once 'WeatherXml.php';
include_once 'WeatherJson.php';
include_once 'ConfigWeather.php';

AbstractWeather::getFactory(); //сохраняет данные погоды в файлы json или xml, в зависимости от указанного в конфиге const FORMAT
