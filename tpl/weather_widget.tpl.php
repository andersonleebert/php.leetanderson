<li class="box box-bg">
    <h2 class="tm-section-title tm-section-title-box tm-box-bg-title">Today</h2>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <h2 class="tm-section-title tm-section-title-box tm-box-bg-title">Tomorrow</h2>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <h2 class="tm-section-title tm-section-title-box tm-box-bg-title"><?php echo DateTime::createFromFormat("Y-m-d",$weatherDayAfter['date'])->format("l"); ?></h2>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>


<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title"><?php echo $weatherToday['temp']; ?><?php echo $degF; ?><br /><img src="images/<?php echo $weatherImage; ?>" /></p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title">
        <?php echo $weatherTomorrow['day_max_temp']; ?><?php echo $degF; ?><img src="images/<?php echo $weatherTomorrowDayImage; ?>" />
    </p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title">
        <?php echo $weatherDayAfter['day_max_temp']; ?><?php echo $degF; ?><img src="images/<?php echo $weatherDayAfterDayImage; ?>" />
    </p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>


<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title">
        <?php echo $weatherToday['weather_text']; ?>
    </p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title">
        <?php echo $weatherTomorrow['night_min_temp']; ?><?php echo $degF; ?><img src="images/<?php echo $weatherTomorrowNightImage; ?>" />
    </p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>
<li class="box box-bg">
    <p class="tm-section-title tm-section-title-box tm-box-bg-title">
        <?php echo $weatherDayAfter['night_min_temp']; ?><?php echo $degF; ?><img src="images/<?php echo $weatherDayAfterNightImage; ?>" />
    </p>
    <img src="images/white-bg.jpg" alt="Image" class="img-fluid">
</li>







