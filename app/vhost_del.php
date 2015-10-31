<?php
include 'function.php';

$id = $_GET['id'];
if (empty($id)) {
	echo "bad request";
	die;
}


//get vhost record
$sql = "select * from vhost where id=$id";
$row = db_get_row($sql);
if (empty($row)) {
	echo "no result found";
	die;
}

print_r($row);
$document_root = $row["document_root"];

//delete record
db_exec("delete from vhost where id='$id'");

//delete deployer dir
echo "delete document_root:$document_root";
system("rm -Rf $document_root");

//delete vhost config

