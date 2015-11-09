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
		function download() {
			$filename = "/www/backup/".$_GET['file'];
		
			$fileinfo = pathinfo($filename);
			header('Content-type: application/x-'.$fileinfo['extension']);
			header('Content-Disposition: attachment; filename='.$fileinfo['basename']);
			header('Content-Length: '.filesize($filename));
			readfile($filename);
			exit();
		}
		function delete() {
			$filename = $_GET['file'];
			if (empty($filename)) die("bad parameter");
			$filename = "/www/backup/".$filename;
			system("rm -f $filename");
		
		}
		function un() {
			$filename = $_GET['file'];
			if (empty($filename)) die('bad parameter');
			$filename = "/www/backup/$filename";
			system("tar xf $filename -C /www/backup/");
		}
}
?>
