<?php
require_once "lib/common.php";

session_start();

// logout
if ($_GET['logout'] == 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    die;
}
// echo getip();
if (is_post()) {
    $ip = getip();
    $time = time();
    $uid = $_POST['uid'];
    
    if ( ($_POST['pwd']== "good") && ($_POST['uid'] == date("m-d")) ) { //判断登录是否正确
        //判断ip是否在不允许登录列表
        if (!empty($ip)) {
            //更新拒绝列表
            $sql = "update reject set state=0 where state=1 and deadline<$time and deadline>0";
            db_exec($sql);
            //判断是否位于拒绝列表中
            $reject = db_get_row("select * from reject where ip='$ip' and state=1");
            //echo "select * from reject where ip='$ip' and state=1";
            
            if ($reject) {
                db_exec("insert into login_log values(null,'$ip','$uid',$time,0,'reject login')");
                header("Location: login.php");
            } else {
                //插入登录日志
                db_exec("insert into login_log values(null,'$ip','$uid',$time,1,'login success')");
                $_SESSION['admin'] = "hao";
                header("Location: index.php");
            }
            die;
        } else {
            
            header("Location: login.php");
            die;
        }
    } else {
        //登录失败,记录登录日志
        //如果当天登录超3次,禁止登录
        db_exec("insert into login_log values(null,'$ip','$uid',$time,0,'login fail')");
        $day_start = strtotime(date('Y-m-d').' 00:00:00');
        $day_end = strtotime(date('Y-m-d').' 23:59:59');
        $count = db_get_field("select count(*) count from login_log where ip='$ip' and state=0 and ctime>$day_start and ctime<$day_end");
        if ($count >= 3) {
            $deadline = $time + 86400; //一天之后的时间戳
            $sql = "insert into reject values(null,'$ip',$deadline,$time,1)";
            db_exec($sql);
        }
        header("Location: login.php");
        
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