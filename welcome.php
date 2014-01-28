<?php

session_start();
if (isset($_SESSION['id'])){
    echo "<h1 align='center'> Welcome</h1>";
    session_destroy();
}else{
    header('Location: picture.php');
}
    
?>
