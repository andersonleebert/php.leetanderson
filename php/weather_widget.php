<?php
require_once('../inc/base.class.php');
$baseObject = new base();
$baseObject->tableName = "weather_codes";
$baseObject->keyField = "weather_codes_id";

$result = json_decode(base::curlGet("http://www.myweather2.com/developer/forecast.ashx?uac=" . $baseObject->weatherUAC . "&output=json&query=50233&temp_unit=f"), true);
$weatherToday = $result['weather']['curren_weather'][0];
$weatherTomorrow = $result['weather']['forecast'][0];
$weatherDayAfter = $result['weather']['forecast'][1];
$degF = "&#176;" . strtoupper($weatherToday['temp_unit']);
$baseObject->load($weatherToday['weather_code']);

$weatherTimeOfDay = 'weather_codes_night_image';
if ( date_sunrise(time(),SUNFUNCS_RET_TIMESTAMP,41.600545,-93.609106, 90,-6) < time() && date_sunset(time(),SUNFUNCS_RET_TIMESTAMP,41.600545,-93.609106, 90,-6) > time()) {
    $weatherTimeOfDay = 'weather_codes_day_image';
}
$weatherImage = $baseObject->data[$weatherTimeOfDay];
include_once('../tpl/weather_widget.tpl.php');
?>
