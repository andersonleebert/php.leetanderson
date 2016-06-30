<?php
if ( isset($_GET['return']) )
{
    $returnURL = filter_var( $_GET['return'] , FILTER_SANITIZE_STRING);
    $returnURL .= '_list.php';
}
else
{
    $returnURL = 'index.php';
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Thank you!</title>
</head>
<body>
<p>Your request was processed.</p>
<p><a href="<?php echo $returnURL; ?>">Back</a></p>
</body>
</html>
