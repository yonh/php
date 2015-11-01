<?php
class BackupController extends Controller {
		function index() {
			$id = $_GET['id'];
			
			$vhosts = db_get_rows("select * from vhost");
			print_r($vhosts);

			//$this->view('index/index.html');
		}
}
?>
