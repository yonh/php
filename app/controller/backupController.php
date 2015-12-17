<?php
class BackupController extends Controller {
		function index() {
			$dir="/www/backup/";
			$file=scandir($dir);
			foreach ($file as $key=>$value)
			{
			    if ($value === "." || $value === "..") {
				    unset($file[$key]);
			    }
			}
			
			$this->assign('list', $file);
			$this->view("backup_index.php");
		}
		function files() {
		    $id = intval($_GET['id']);
		    $vhost = db_get_row("select * from vhost");
		    if ($vhost) {
		        $files = db_get_rows("select * from backup");
		        $this->assign("list", $files);
		        $this->assign("vhost", $vhost);
		    }
		    
		    $this->view("backup_files.php");
		}
		function backup() {
			$id = intval($_GET['id']);
			if ($id>0) {
				$vhost = db_get_row("select * from vhost where id='$id'");
				//$time =  date("Ymd_h_i");
				$time = time();
				$filename = "/www/backup/".$vhost['name']."-".$time.".tar.gz";
				exec("tar jcvf $filename -C /var/www ".$vhost['name']);
				
				db_exec("insert into backup values(null, $id, $time, '$filename')");
				

			} else {
				echo "vhost not exists";
			}
		}
		function download() {
			$filename = $_GET['filename'];

			$fileinfo = pathinfo($filename);
			header('Content-type: application/x-'.$fileinfo['extension']);
			header('Content-Disposition: attachment; filename='.$fileinfo['basename']);
			header('Content-Length: '.filesize($filename));
			readfile($filename);
			exit();
		}
		function delete() {
		    $id = intval($_GET['id']);
		    $file = db_get_row("select * from backup where id='$id'");
		    
			if (empty($file)) die("bad parameter");
			$filename = $file['filename'];
			db_exec("delete from backup where id='$id'");
			system("rm -f $filename");
		}
		
		//回滚版本
		function rollback() {
		    $id = $_GET['id'];
		    
			$sql = "select vhost.name,backup.filename from backup join vhost on backup.pid=vhost.id where backup.id=$id";
			$backup = db_get_row($sql);
			$name = $backup['name'];
			$filename = $backup['filename'];

			system("tar xvf $filename -C /www/backup/"); //解压备份文件
			system("cp -rf /www/backup/$name /var/www"); //拷贝到部署目录
			system("rm -rf /www/backup/$name");
		}
}
?>
