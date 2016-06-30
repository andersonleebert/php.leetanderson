<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageData['pages_title']; ?></title>
    <?php 
        if( !empty($pageData['pages_meta']) )
        {
    ?>
            <meta name="keywords" content="<?php echo $pageData['pages_meta']; ?>">
    <?php
        }
    ?>
</head>
<body>
<div style="width: 50%;float: right;">
    <?php
        include_once("weather_widget.php");
    ?>
</div>

<div>
    Menu:
    <ul>
        <?php
            while ( $row = $menuSTMT->fetch(PDO::FETCH_ASSOC) )
            {
        ?>
                <li><a href="<?php echo 'index.php?page=' . $row['pages_url_key']; ?>"><?php echo $row['pages_title']; ?></a></li>
        <?php
            }
        ?>
        <li><a href="news_list.php">Manage News</a></li>
        <li><a href="user_list.php">Manage Users</a></li>
        <li><a href="page_list.php">Manage Pages</a></li>
    </ul>
</div>


<div class="pageContent">
    <h1><?php echo $pageData['pages_h1']; ?></h1>
    <?php
    if ( !empty($pageData['pages_image']) )
    {
    ?>
    <img src="<?php echo $pageData['pages_image']; ?>" />
    <?php
    }

    ?>
    <div><?php echo $pageData['pages_content']; ?></div>    
</div>


<div style="width: 100%;clear: both;border: 2px solid black">
    <h2>Current News</h2>
    <?php
        include_once("news_widget.php");
    ?>
</div>


</body>
</html>
