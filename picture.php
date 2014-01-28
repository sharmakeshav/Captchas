<?php
require 'connect.inc.php';
session_start();
$flag = 0;
if (!isset($_POST['secure'])) {
    $random = rand(1, 5);
    $_SESSION['num'] = $random;
    $query = "SELECT `url` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $_SESSION['url'] = mysql_result($query_run, 0, 'url');
        $urlDisplay = $_SESSION['url'];
    }
    $query = "SELECT `url1` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $_SESSION['url1'] = mysql_result($query_run, 0, 'url1');
        $url1Display = $_SESSION['url1'];
    }
    $query = "SELECT `url2` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $_SESSION['url2'] = mysql_result($query_run, 0, 'url2');
        $url2Display = $_SESSION['url2'];
    }
    $query = "SELECT `url3` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $_SESSION['url3'] = mysql_result($query_run, 0, 'url3');
        $url3Display = $_SESSION['url3'];
    }
} else {
    $user = $_POST['secure'];
    $name = $_POST['user'];
    $pass = $_POST['password'];
    $pass = md5($pass);
    $query = "SELECT `correct` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
    if ($query_run = mysql_query($query)) {
        $table = mysql_result($query_run, 0, 'correct');
    }
    $query_userpass = "SELECT id FROM authenticate WHERE username='$name' AND password='$pass'";
    if ($query_run = mysql_query($query_userpass)) {
        if (mysql_num_rows($query_run) == 0) {
            $flag = 0;
        } else {
            $_SESSION['id'] = mysql_result($query_run, 0, 'id');
            $flag++;
        }
    }
    if ($table == $user && $flag != 0) {
        header('Location: welcome.php');
    } else {
        echo "<script>alert('Incorrect username,password combination or incorrect captcha')</script>";
        $random = rand(1, 5);
        $_SESSION['num'] = $random;
        $query = "SELECT `url` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
        if ($query_run = mysql_query($query)) {
            $_SESSION['url'] = mysql_result($query_run, 0, 'url');
            $urlDisplay = $_SESSION['url'];
        }
        $query = "SELECT `url1` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
        if ($query_run = mysql_query($query)) {
            $_SESSION['url1'] = mysql_result($query_run, 0, 'url1');
            $url1Display = $_SESSION['url1'];
        }
        $query = "SELECT `url2` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
        if ($query_run = mysql_query($query)) {
            $_SESSION['url2'] = mysql_result($query_run, 0, 'url2');
            $url2Display = $_SESSION['url2'];
        }
        $query = "SELECT `url3` FROM `picture` WHERE `id`='" . $_SESSION['num'] . "'";
        if ($query_run = mysql_query($query)) {
            $_SESSION['url3'] = mysql_result($query_run, 0, 'url3');
            $url3Display = $_SESSION['url3'];
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
                <form action="picture.php" method="POST">
                    <h1>Login Here</h1>
                    <label>Username :</label>
                    <input type="text" id="input" name="user" required placeholder="Ex. johndoe" />
                    <label>Password :</label>
                    <input type="password" id="input" name="password" required placeholder="********" /><br/>
                    <div class="row">
                        <div class="four column"></div>
                        <div class="four column">
                            <img src=<?php echo $urlDisplay; ?> id="img" /><br/>
                        </div>
                        <div class="four column"></div> 
                    </div>
                    <br>
                    <div class="row">
                        <div class="twelve column">
                            <p>Drag and drop the image that resembles the image given above into the textbox</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="four column">
                            <img src=<?php echo $url1Display; ?> id="img1" /><br/>
                        </div>
                        <div class="four column">
                            <img src=<?php echo $url2Display; ?> id="img1" /><br/>
                        </div>
                        <div class="four column">
                            <img src=<?php echo $url3Display; ?> id="img1" /><br/>
                        </div>
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
                            <a href="logic.php">Logical Captcha</a>
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