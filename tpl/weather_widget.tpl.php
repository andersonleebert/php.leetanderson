<style type="text/css">
    .weatherWidget{
        max-width: 900px;
        width: 100%;
        min-height: 200px;
    }

    .weatherDays{
        float: left;
        width: 33%;
        outline: solid 1px black;
    }
    .weatherHourly{
        float: left;
        width: 50%;
    }

</style>

<div class="weatherWidget">
    <h3>Weather</h3>
    <div class="weatherDays">
        <b>Now</b>
        <div>Temperature: <?php echo $weatherToday['temp']; ?><?php echo $degF; ?></div>
        <div>Humidity: <?php echo $weatherToday['humidity']; ?></div>
        <div>Barometric Pressure: <?php echo $weatherToday['pressure']; ?></div>
        <div><img src="images/<?php echo $weatherImage; ?>" /></div>
        <div><?php echo $weatherToday['weather_text']; ?></div>
        <div>Winds blowing <?php echo $weatherToday['wind'][0]['dir'] . " at " . $weatherToday['wind'][0]['speed'] . $weatherToday['wind'][0]['wind_unit']; ?></div>
    </div>
    <div class="weatherDays">
        <b>Forecast for: <?php echo $weatherTomorrow['date']; ?></b>
        <div>High: <?php echo $weatherTomorrow['day_max_temp']; ?><?php echo $degF; ?></div>
        <div>Low: <?php echo $weatherTomorrow['night_min_temp']; ?><?php echo $degF; ?></div>
        <div class="weatherHourly">
            <div>Day</div>
            <div>Image: <?php echo $weatherTomorrow['day'][0]['weather_code']; ?></div>
            <div><?php echo $weatherTomorrow['day'][0]['weather_text']; ?></div>
            <div>Winds blowing <?php echo $weatherTomorrow['day'][0]['wind'][0]['dir'] . " at " . $weatherTomorrow['day'][0]['wind'][0]['speed'] . $weatherTomorrow['day'][0]['wind'][0]['wind_unit']; ?></div>
        </div>
        <div class="weatherHourly">
            <div>Night</div>
            <div>Image: <?php echo $weatherTomorrow['night'][0]['weather_code']; ?></div>
            <div><?php echo $weatherTomorrow['night'][0]['weather_text']; ?></div>
            <div>Winds blowing <?php echo $weatherTomorrow['night'][0]['wind'][0]['dir'] . " at " . $weatherTomorrow['night'][0]['wind'][0]['speed'] . $weatherTomorrow['night'][0]['wind'][0]['wind_unit']; ?></div>
        </div>
    </div>
    <div class="weatherDays">
        <b>Forecast for: <?php echo $weatherDayAfter['date']; ?></b>
        <div>High: <?php echo $weatherDayAfter['day_max_temp']; ?><?php echo $degF; ?></div>
        <div>Low: <?php echo $weatherDayAfter['night_min_temp']; ?><?php echo $degF; ?></div>
        <div class="weatherHourly">
            <div>Day</div>
            <div>Image: <?php echo $weatherDayAfter['day'][0]['weather_code']; ?></div>
            <div><?php echo $weatherDayAfter['day'][0]['weather_text']; ?></div>
            <div>Winds blowing <?php echo $weatherDayAfter['day'][0]['wind'][0]['dir'] . " at " . $weatherDayAfter['day'][0]['wind'][0]['speed'] . $weatherDayAfter['day'][0]['wind'][0]['wind_unit']; ?></div>
        </div>
        <div class="weatherHourly">
            <div>Night</div>
            <div>Image: <?php echo $weatherDayAfter['night'][0]['weather_code']; ?></div>
            <div><?php echo $weatherDayAfter['night'][0]['weather_text']; ?></div>
            <div>Winds blowing <?php echo $weatherDayAfter['night'][0]['wind'][0]['dir'] . " at " . $weatherDayAfter['night'][0]['wind'][0]['speed'] . $weatherDayAfter['night'][0]['wind'][0]['wind_unit']; ?></div>
        </div>
    </div>
</div>
