<?php
class VhostController extends Controller {
	public function index() {
		$vhosts = db_get_rows("select * from vhost");
		print_r($this->data);
		$this->assign("list", $vhosts);
		$this->view("vhost_index.php");
	}
	public function add() {
		if (is_post()) {
// 			$file = "tmp/domain_name";
// 			$domain_name = $_POST['domain_name'];
// 			$name = $_POST['name'];
// 			$git = $_POST['git'];

// 			// add record to db
// 			$sql = "insert into vhost values(null, '$name', '$git', '$domain_name', '/var/www/$name', '/etc/apache2/sites-available/$name')";
// 			db_exec($sql);
						
// 			$content = $_POST['vhost_conf'];
// 		    write_file($file, $content);
// 			system("./conf_bin " . "tmp/domain_name ". $domain_name.".conf");
		} else {
			$this->view("vhost_add.php");
		}
	}
	public function start() {
	    $name = $_GET['name'];
	    $id = $_GET['id'];
	    if (vhost_start($id, $name)) {
	        echo "网站已开启";
	    } else {
	        echo "操作失败";
	    }
	}
	
	public function stop() {
	    $name = $_GET['name'];
	    $id = $_GET['id'];
	    if (vhost_stop($id, $name)) {
	        echo "网站已关闭";
	    } else {
	        echo "操作失败";
	    }
	}

	public function deployer() {
		$id = $_GET['id'];
		if (empty($id)) {
			echo "bad request";
			die;
		}

		$sql = "select * from vhost where id='$id'";
		$vhost = db_get_row($sql);

		$a = "git clone $vhost[git] /www/git/".$vhost['name'];
		$r = system($a);

		//copy file to deployer dir
		system("cp -rf /www/git/$vhost[name] /var/www");
		echo "done...";	
	}
	public function update() {
		$name = $_GET['name'];
		if (empty($name)) {
			echo "bad request";
			die;
		}

		$a = "cd /www/git/$name; git pull"; 
		$r = system($a);

		//copy file to deployer dir
		system("cp -rf /www/git/$name /var/www");
		echo "done...";	

	}

}
