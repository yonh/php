<?php
require 'config.php';

session_start();

function is_post() {
		return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get() {
		return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function api_get($url) {
	    $url = API_SERVER.$url;
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
			    curl_setopt($curl, CURLOPT_URL, $url);
				    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
				    $res = curl_exec($curl);

					    return json2arr($res);
}
/**
 *  * json转array,若数据不是json结构,返回系统错误异常的数组
 *   * @param  [type] $s json
 *    * @return [type]    array(ret_msg,status,result)
 *     */
function json2arr($s) {
	    $arr = json_decode($s, true);
		    
		    if (json_last_error() == JSON_ERROR_NONE) {
				        return $arr;
						    } else {
								        return array('status'=>false, 'ret_msg'=>'系统异常');
										    }
}


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


function write_file($file, $content) {
	    $file = fopen($file, "w") or die("Unable to open file!");
		    $txt = "Bill Gates\n";
		    fwrite($file, $content);
			    fclose($file);
}

?>
