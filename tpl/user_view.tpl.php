<!DOCTYPE html>
<html>
<head>
    <title>View User</title>
</head>
<body>
    <img src="<?php echo $userData['user_image']; ?>" />
    <h1><?php echo $userData['user_id']; ?></h1>
    <p><?php echo $userData['user_username']; ?></p>
    <p><?php echo $userData['']; ?></p>
    <p><?php echo $userData['']; ?></p>
    <p><a href="user_list.php">Back to List</a></p>
</body>
</html>
