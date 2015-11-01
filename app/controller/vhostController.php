<?php
class VhostController extends Controller {
	public function index() {
		$vhosts = db_get_rows("select * from vhost");
		print_r($this->data);
		$this->assign("list", $vhosts);
		$this->view("vhost_index.php");
	}
	public function add() {
		/*if (is_post()) {
			$file = "tmp/domain_name";
			$domain_name = $_POST['domain_name'];
			$name = $_POST['name'];
			$git = $_POST['git'];

			// add record to db
			$sql = "insert into vhost values(null, '$name', '$git', '$domain_name', '/var/www/$name', '/etc/apache2/sites-available/$name')";
			db_exec($sql);
						
			$content = $_POST['vhost_conf'];
		    write_file($file, $content);
			system("./conf_bin " . "tmp/domain_name ". $domain_name.".conf");
		} else {
			$this->view("vhost_add.php");
		}
		*/
	}

}
