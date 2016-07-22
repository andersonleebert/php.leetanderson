<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $pageData['title']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        if( !empty($pageData['meta']) )
        {
    ?>
            <meta name="keywords" content="<?php echo $pageData['meta']; ?>">
    <?php
        }
    ?>
<!--
Elevate
http://www.templatemo.com/tm-481-elevate
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400">   <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
    <div class="container">

        <div class="tm-sidebar">
            <img src="images/menu-top.jpg" alt="Menu top image" class="img-fluid tm-sidebar-image">
            <nav class="tm-main-nav">
                <ul>
                    <?php
                        while ( $row = $menuSTMT->fetch(PDO::FETCH_ASSOC) )
                        {
                    ?>
                            <li class="tm-nav-item"><a class="tm-nav-item-link" href="<?php echo 'index.php?page=' . $row['pages_url_key']; ?>" ><?php echo $row['pages_title']; ?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </nav>
        </div>
        
        <div class="tm-main-content">
            
            <section id="home" class="tm-content-box tm-banner margin-b-10">
                <div class="tm-banner-inner">
                    <p class="tm-banner-title"><?php echo $pageData['h1']; ?></p>
                    <p class="tm-banner-text"><?php echo $pageData['subheader']; ?></p>    
                </div>                    
            </section>

            <section>
                <div class="tm-content-box flex-2-col">
                    
                    <div class="pad flex-item tm-team-description-container">
                        <p class="tm-section-description"><?php echo $pageData['content']; ?></p>
                    </div>                  

                </div>
                <div id="about" class="tm-content-box">
                    
                    <ul class="boxes gallery-container">
                        <?php
                            if ($isHomePage)
                            {
                                include_once("weather_widget.php");
                            }
                        ?>
                    </ul>

                </div>
                
            </section>

            <!-- slider -->
            <section id="ideas">
                <div id="tmCarousel" class="carousel slide tm-content-box" data-ride="carousel">
                    
                    

                    <div class="carousel-inner" role="listbox">
                        <?php
                            $newsIndex = 0;
                            while ( $row = $newsSTMT->fetch(PDO::FETCH_ASSOC) )
                            {
                        ?>
                                <div class="carousel-item<?php echo ( $newsIndex == 0? " active" : ""); ?>">
                                    <div class="carousel-content">
                                        <div class="flex-item full-width">
                                            <h2 class="tm-section-title"><?php echo $row['article_title'] ?></h2>
                                            <p class="tm-section-description carousel-description"><?php echo $row['article_content']?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $newsIndex++;
                            }
                        ?>
                    </div>
                    <ol class="carousel-indicators">
                        <?php
                            for ($i=0; $i < $newsIndex; $i++)
                            { 
                        ?>
                            <li data-target="#tmCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ( $i == 0? "active" : ""); ?>"></li>
                        <?php      
                            }
                        ?>
                    </ol>
                    
                </div>                    
            </section>
 

            <footer class="tm-footer">
                <p class="text-xs-center"><a href="admin.php">Login</a> | Design: <a rel="nofollow" href="http://www.templatemo.com/tm-481-elevate" target="_parent">Elevate</a></p>
            </footer>

        </div>
         
    </div>


    <!-- load JS files -->
    
    <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/getting-started/download/) -->
    


</body>
</html>
