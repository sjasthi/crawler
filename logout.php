<?php
        ob_start();
        session_start();
        if(session_destroy()){
            header('Location: login.php');
        }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout Session</title>
</head>
<body>
</body>
</html>