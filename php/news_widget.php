<?php

require_once('../inc/base.class.php');
$baseObject = new base();
$newsWidgetData = json_decode( base::curlGet($_SERVER["HTTP_HOST"] . "/WebDev441/week14/public_html/rest_get_articles.php"), true );
$randomNewsData = $newsWidgetData[rand(0, count($newsWidgetData)-1 )];

include_once('../tpl/news_widget.tpl.php');
?>
