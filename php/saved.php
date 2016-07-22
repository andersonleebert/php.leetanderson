<?php
if ( isset($_GET['return']) )
{
    $returnURL = "admin.php?r=" . filter_var( $_GET['return'] , FILTER_SANITIZE_STRING);
}
else
{
    $returnURL = 'admin.php';
}


?>