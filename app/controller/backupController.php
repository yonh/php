<?php
class BackupController extends Controller {
		function index() {
			$dir="/www/backup/";
			$file=scandir($dir);
			foreach ($file as $key=>$value)
			{
				  if ($value === "." || $value === "..")
					      unset($file[$key]);
			}
			
			$this->assign('list', $file);
			$this->view("backup_index.php");
		}
		function backup() {
			$id = intval($_GET['id']);
			if ($id>0) {
				$vhost = db_get_row("select * from vhost where id='$id'");	
				//$time =  date("Ymd_h_i");
				$time = time();
				system("tar jcvf /www/backup/".$vhost['name']."-".$time.".tar.bz2 -C /var/www ".$vhost['name']);

			} else {
				echo "vhost not exists";
			}
		}
}
?>
