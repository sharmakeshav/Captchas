<?php
require 'connect.inc.php';
session_start();
$flag=0;
if (!isset($_POST['secure'])) {
    $random = rand(1, 5);
    $_SESSION['num'] = $random;
    $query = "SELECT `question` FROM `logical` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $query_num_rows = mysql_num_rows($query_run);
        $_SESSION['secure'] = mysql_result($query_run, 0, 'question');
    }
} else {
    $user = $_POST['secure'];
    $user = $_POST['secure'];
    $name = $_POST['user'];
    $pass = $_POST['password'];
    $pass = md5($pass);
    $query_userpass = "SELECT id FROM authenticate WHERE username='$name' AND password='$pass'";
    if ($query_run = mysql_query($query_userpass)) {
        if (mysql_num_rows($query_run) == 0) {
            $flag = 0;
        } else {
            $_SESSION['id'] = mysql_result($query_run, 0, 'id');
            $flag++;
        }
    }
    $query = "SELECT `answer` FROM `logical` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $query_num_rows = mysql_num_rows($query_run);
        $table = mysql_result($query_run, 0, 'answer');
    }
    if ($table == $user && $flag != 0) {
        header('Location: welcome.php');
    } else {
        echo "<script>alert('Incorrect username/password or incorrect captcha')</script>";
        $random = rand(1, 5);
        $_SESSION['num'] = $random;
        $query = "SELECT `question` FROM `logical` WHERE `id`='" . $_SESSION['num'] . "'";
        if ($query_run = mysql_query($query)) {
            $query_num_rows = mysql_num_rows($query_run);
            $_SESSION['secure'] = mysql_result($query_run, 0, 'question');
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta content="en-us" http-equiv="Content-Language" />
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="stylesheets/foundation.min.css" />
        <link rel="stylesheet" href="stylesheets/app.css" />
        <link rel="stylesheet" href="style.css" />
        <script src="javascripts/modernizr.foundation.js"></script>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="row">
            <div class="three column blank"></div>
            <div class="six column" id="content">
                <form action="logic.php" method="POST">
                    <h1>Login Here</h1>
                    <label>Username :</label>
                    <input type="text" id="input" name="user" required placeholder="Ex. johndoe" />
                    <label>Password :</label>
                    <input type="password" id="input" name="password" required placeholder="********" /><br/>
                    <div class="row">
                        <div class="two column"></div>
                        <div class="eight column">
                            <img src="generate_logic.php" /><br/>
                        </div>
                        <div class="two column"></div> 
                    </div>
                    <div class="row">
                        <div class="three column"></div>
                        <div class="six column">
                            <input type="text" id="captcha" name="secure"/>
                        </div>
                        <div class="three column"></div>
                    </div>
                    <div class="row">
                        <div class="six column">
                            <a href="index.php">Text Captcha</a>
                        </div>
                        <div class="six column">
                            <a href="picture.php">Image Captcha</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="three column"></div>
                        <div class="six column">
                            <input type="submit" id="submit" value="Login" />
                        </div>
                        <div class="three column"></div>
                    </div>
                </form>
            </div>
            <div class="three column blank"></div>
        </div>
    </body>
</html>