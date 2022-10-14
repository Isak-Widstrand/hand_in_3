<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">

</head>

<body>
    <?php

    $loginStatus = false;

    $validateLogin = file("loginfo.txt");

    function checkExistingLogin($validateLogin, $savedUsername, $savedPassword)
    {
        foreach ($validateLogin as $line) {
            $userInfo = explode(";", $line);
            $username = trim($userInfo[0]);
            $password = trim($userInfo[1]);

            if ($savedUsername == $username && $savedPassword == $password) {
                echo "<h1>Welcome back ", $username, "</h1>";
                return $loginStatus = true;
            } else {
                echo "<h2>Incorrect username or password</h2>";
            }
        }
    }

    $_SESSION["validate"] = false;

    $loginStatus = checkExistingLogin($validateLogin, $_POST["uname"], $_POST["psw"]);

    if ($loginStatus == true) {

        $_SESSION["uname"] = $_POST["uname"];
        $_SESSION["validate"] = true;
        echo '
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Choose a file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <input type="submit" value="Upload" name="submit" />
  </form>';
    }


    ?>

    <a href="login.html">Back to site</a>

</body>

</html>