<?php
require 'login.php';

require dirname(__FILE__).'/lib/common.php';
require dirname(__FILE__).'/lib/controller.php';

header("Content-type: text/html; charset=utf-8");

//请求必须包含参数c=controller, a=action
//如 localhost/index.php?c=user&a=login
//引入controller文件
$dir = @ dir("controller");
while (($file = $dir->read()) !== false)
{
	if ($file!='.' && $file!='..')
  		require 'controller/'.$file;
}


//默认action=index, 默认controller=VhostController
//获取controller和action
$c = ($_REQUEST['c']?ucfirst($_REQUEST['c']):"Vhost")."Controller";
$a = $_REQUEST['a']?$_REQUEST['a']:'index';

//controller调用action方法
if (class_exists($c)) {//是否存在controller
	$controller = new $c();
	$controller->$a();
} else {
	echo "404";
}

?>
