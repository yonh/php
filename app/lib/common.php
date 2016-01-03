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

function db_get_field($sql, $field) {
    $row = db_get_row($sql);
    if (count($row)>0)
        return $row[0][$field];
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


// $id: vhost id,
// $name: vhost name
// $status: run status 1 run, 0 close
function vhost_run_or_close($id, $name, $status) {
    $id = intval($id);
    if (empty($id)) return false;
    
    if ($status==1) {
        $status = 1;
    } else {
        $status = 0;
    }
    
    $s = ROOT_DIR."bin/a2site $status $name";
    exec($s);
    $sql = "update vhost set is_running=$status where id=$id";
    db_exec($sql);
    return true;
}
/// vhost operate
function vhost_start($id, $name) {
    return vhost_run_or_close($id, $name, 1);
}
/// vhost operate
function vhost_stop($id, $name) {
    return vhost_run_or_close($id, $name, 0);
}

function getip() { 
    $unknown = 'unknown'; 
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){ 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) { 
        $ip = $_SERVER['REMOTE_ADDR']; 
    } 
    /**
     * 处理多层代理的情况
     * 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
     */
    if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip)); 
    return $ip; 
}

?>
