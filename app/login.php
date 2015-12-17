<?php
session_start();




if ($_POST['pwd']== "good") {
    if ($_POST['uid'] == date("m-d")) {
        $_SESSION['admin'] = "hao";

        header("Location: index.php");
        die;
    }
} else {
    if ($_SESSION['admin'] !="hao") {
        echo '<form action="login.php" method="POST">';
        echo '<input type="text" name="uid" />';
        echo '<input type="password" name="pwd" />';
        echo '<input type="submit" value="login" />';
        echo '</form>';
        exit;
    }
}
?>