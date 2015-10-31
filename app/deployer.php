<?php
include 'function.php';

$id = $_GET['id'];
if (empty($id)) {
	echo "bad request";
	die;
}

$sql = "select * from vhost where id='$id'";
$vhost = db_get_row($sql);

$a = "git clone $vhost[git] /www/git/".$vhost['name'];
$r = system($a);
print_r($r);

//copy file to deployer dir
system("cp -rf /www/git/$vhost[name] /var/www");
