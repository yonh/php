<?php

function connect_db() {
	$db;
	try {
       		$db = new PDO('mysql:host=localhost;dbname=server_ui', 'root', 'root');

	} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
	}
	return $db;
}

function db_get_rows($sql) {
	$db = connect_db();
	$list = $db->query($sql)->fetchAll();
	return $list;
}
function db_get_row($sql) {
	$list = db_get_rows($sql);	
	if (count($list)>0)
		return $list[0];
	return "";
}


function db_exec($sql) {
	$db = connect_db();
	return $db->exec($sql);
}

function is_post() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get() {
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function write_file($file, $content) {
	$file = fopen($file, "w") or die("Unable to open file!");
	$txt = "Bill Gates\n";
	fwrite($file, $content);
	fclose($file);
}
