<!DOCTYPE html>
<html lang="en">
<head>
    <title>CMS Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <nav class="tm-main-nav">
                <ul>
                    <li class="tm-nav-item"><a class="tm-nav-item-link" href="?r=pages" >Edit Pages</a></li>
                    <li class="tm-nav-item"><a class="tm-nav-item-link" href="?r=news" >Edit Posts</a></li>
                    <li class="tm-nav-item"><a class="tm-nav-item-link" href="?r=users" >Edit Users</a></li>
                    <li class="tm-nav-item"><a class="tm-nav-item-link" href="?r=logout" >Logout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="tm-main-content">
            
            <section>
                <div class="tm-content-box flex-2-col">
                    <div class="pad flex-item">
                        <?php include($adminTemplatePath); ?>
                    </div>
                    
                </div>
            </section>

            <footer class="tm-footer">
                <p class="text-xs-center">Design: <a rel="nofollow" href="http://www.templatemo.com/tm-481-elevate" target="_parent">Elevate</a></p>
            </footer>

        </div>
         
    </div>


    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script>
</body>
</html>
