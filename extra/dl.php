<?php
if(!$_POST['file'] && $_POST['pfile'] && $_POST['ispublic']) {
	
	$root = "../data/".$_POST['puser'];
	$file = basename($_POST['pfile']);
	$path = $root.urldecode($file);
	$type = '';
	$ispublic = explode(".", urldecode($file));
				$ispublic = base64_decode($ispublic[0]);
				$ispublic = explode("->", $ispublic);
				$ispublic = $ispublic[1];
				if($ispublic != 1) {
					header("Location: ../?/public/error");
				} else {
	if (is_file($path)) {
		$size = filesize($path);
		if (function_exists('mime_content_type')) {
			$type = mime_content_type($path);
		} else if (function_exists('finfo_file')) {
				$info = finfo_open(FILEINFO_MIME);
				$type = finfo_file($info, $path);
				finfo_close($info);
			}
		if ($type == '') {
			$type = "application/force-download";
			}
		// Set Headers
		$filexp = explode(".", $file);
		$filen = str_replace($filexp[0].".", "", $file);
		header("Content-Type: ".$type);
		header("Content-Disposition: attachment; filename=".$filen);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $size);
		// Download File
		readfile($path);

	} else {

		header("Location: ../?/public/error");
	}
}

}
session_start();
include("db.php");
include("functions.php");

if($_GET) {
	die("GET not allowed");
}
if (!isset($_POST['file']) || empty($_POST['file'])) {
	exit();
}
$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());


mysql_select_db($dbname, $dbconnect) or die("could not select database<br>".mysql_error());

$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());

while($r[]=mysql_fetch_row($result));
$user = $_SESSION['user'];

$index = findIndexByName($r, $user, 0);

$passwd = sha1($_SESSION['usualpass']);

if($passwd == $r[$index][1]) {

	$root = "../data/".$_SESSION['user']."/";
	$file = basename($_POST['file']);
	$path = $root.urldecode($file);
	$type = '';
	if (is_file($path)) {
		$size = filesize($path);
		if (function_exists('mime_content_type')) {
			$type = mime_content_type($path);
		} else if (function_exists('finfo_file')) {
				$info = finfo_open(FILEINFO_MIME);
				$type = finfo_file($info, $path);
				finfo_close($info);
			}
		if ($type == '') {
			$type = "application/force-download";
		}
		// Set Headers
		$filexp = explode(".", $file);
		$filen = str_replace($filexp[0].".", "", $file);
		header("Content-Type: ".$type);
		header("Content-Disposition: attachment; filename=".$filen);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $size);
		// Download File
		readfile($path);

	} else {
		die("file not found");
	}


} else {

	//die("error");

}


?>