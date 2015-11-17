<?php
class SecurityController extends Controller {
	public function index() {
	//	system("md5sum /home/ubuntu/server_ui/app/index.php");
		echo md5_file("/home/ubuntu/server_ui/app/index.php");
		echo sha1_file("/home/ubuntu/server_ui/app/index.php");

	}	
}
///home/ubuntu/server_ui/app
