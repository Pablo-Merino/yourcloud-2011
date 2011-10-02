<?php
global $dbuser, $dbpass, $host;
session_start();
include("db.php");
switch($_POST['action']) {
case "login":
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

	login($_POST['user'], $_POST['pass'], $dbconnect);
	break;
case "delete":
	$filename = urldecode($_POST['filename']);
	$username = $_SESSION['user'];
	unlink("../data/".$username."/".$filename);
	header("Location: ../?/profile/files");
	break;
case "beta":
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

	addtobeta($_POST['mail'], $dbconnect);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/register/done">';
	break;
case "register":
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

	register($_POST['user'], $_POST['pass'], $_POST['mail'], $dbconnect);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/invites/done">';
	break;
case "chpass":
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

	chpass($_POST['user'], $_POST['oldpass'], $_POST['newpass'], $_POST['checkpass'], $dbconnect);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/profile/settings/done">';
	break;
case "newinvitepass":
	$newpass = genRandomString();
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());
	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$test2 = mysql_query("UPDATE  system SET  `invitepass` =  '$newpass';", $dbconnect) or die(mysql_error());
	header("Location: ../?/admin");
	break;
case "cleaninvites":
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

	cleaninvites($dbconnect);
	header('Location: ../?/admin');
	break;
case "wipeacc":
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());
	$passchk = checkpass($user, $pass, $dbconnect);
	if($passchk) {

		SureRemoveDir("../data/".$user."/", false);
		header("Location: ../?/profile/settings/done");

	} else {
		header("Location: ../?/profile/error/4");

	}
	//unlink("../data/".$username."/".$filename);
	break;
case "addpost":
	$title = $_POST['title'];
	$date = $_POST['date'];
	$author = $_POST['author'];
	$content = $_POST['content'];
	//echo $title."<br>".$date."<br>".$author."<br>".$content;
	$data = array("title"=>$title,"author"=>$author,"date"=>$date,"body"=>$content);
	$post = "";
	//print_r($data);
	foreach($data as $key => $value) {
		$post .= $key.": ".$value."\r\n";
	}
	$dirlistnormal = getDirectoryList('./extra/blogposts/');

	$post_number = count($dirlistnormal) + 1;

	$post_name = "./blogposts/".$post_number.".post";

	$file_stream = fopen($post_name, 'w');
	fwrite($file_stream, $post);
	header("Location: ../?/admin");

}

function checkpass($user, $pass, $dbconnect) {
	$shapass = sha1($pass);

	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());
	while($r[]=mysql_fetch_row($result));
	$index = findIndexByName($r, $user, 0);

	if ($shapass == $r[$index][1]) {

		return TRUE;

	} else {
		return FALSE;

	}

}
function SureRemoveDir($dir, $DeleteMe) {
	if(!$dh = @opendir($dir)) return;
	while (($obj = readdir($dh))) {
		if($obj=='.' || $obj=='..' || $obj=='.htaccess') continue;
		if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
	}
	if ($DeleteMe){
		closedir($dh);
		@rmdir($dir);
	}
}
function findIndexByName ($array, $name, $indexname) {
	foreach ($array as $index => $entry)
		if ($entry[$indexname] === $name) return $index;
		return -1; // or "false", or "-1", or whatever
}
function cleaninvites($dbconnect) {
	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$result = mysql_query("TRUNCATE TABLE invites", $dbconnect) or die(mysql_error());

}
function getMemDetails() {
	$data = shell_exec("free -t -m | grep \"Mem\"");
	$memdet = explode(" ",$data);
	$newarr = array_values(array_filter($memdet, 'strlen'));
	return $newarr[1]." ".$newarr[2]." ".$newarr[3]." ".$newarr[4]." ".$newarr[5]." ".$newarr[6];
}
function returnLoad() {
	$array = sys_getloadavg();
	return $array[0]." ".$array[1]." ".$array[2];
}

function login($user, $pass, $dbconnect) {

	$passwd = sha1($pass);

	if(!$pass || !$user) {
		header("Location: ../?/login/error");
	} else {


		mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

		$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());

		while($r[]=mysql_fetch_row($result));

		$index = findIndexByName($r, $user, 0);

		if($user == $r[$index][0] && $passwd == $r[$index][1]) {

			session_start();

			$_SESSION['user'] = $user;

			$_SESSION['pass'] = $r[$index][1];

			$_SESSION['max'] = $r[$index][3];

			$_SESSION['userlevel'] = $r[$index][4];

			$_SESSION['usualpass'] = $pass;

			$_SESSION['invitepass'] = getNewInvitePass($dbconnect);

			//header('Location: ./frontend/?/profile');

			//echo "yep";
			header("Location: ../?/profile");

		} else {

			header("Location: ../?/login/error");
		}
	}
	mysql_close();
}
function getNewInvitePass($handle){
	mysql_select_db("yc2", $handle) or die("could not select database<br>".mysql_error());

	$result = mysql_query("SELECT * FROM system", $handle) or die(mysql_error());

	while($q[]=mysql_fetch_row($result));

	return $q[0][0];

}
function register($user, $pass, $mail, $dbconnect) {
	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());
	while($r[]=mysql_fetch_row($result));

	if(!$user || !$pass || !$mail) {
		header("Location: ../?/invites/error/1");

	} else if(!ctype_alnum($user)) {
			header("Location: ../?/invites/error/2");

		} else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../?/invites/error/3");

		} else if(findIndexByName($r, $user, 0) != -1) {
			header("Location: ../?/invites/error/4");

		} else {
		if(decrypt($_POST['invitecode'], $_SESSION['invitepass']) == "private-beta-link") {

			$shapass = sha1($pass);
			$result = mysql_query("INSERT INTO users (username, password, email, capacity, userlevel) VALUES('$user', '$shapass', '$mail', 26214400, 0);", $dbconnect) or die(mysql_error());
			$dirname = "../data/".$user;
			$newhtaccess = "../data/".$user."/.htaccess";

			$htaccess = "../data/.htaccess";
			mkdir($dirname, 0777);
			$fh = fopen($newhtaccess, 'w') or die("can't open file");
			$stringData = "AddHandler cgi-script .php .pl .jsp .asp .sh .cgi\nOptions -ExecCGI\n";
			fwrite($fh, $stringData);
			fclose($fh);
		} else {
			header("Location: ../?/invites/error/5");

		}


	}
}
function chpass($user, $oldpass, $newpass, $checkpass, $dbconnect) {
	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());
	while($r[]=mysql_fetch_row($result));

	if(!$user || !$oldpass || !$newpass || !$checkpass) {
		header("Location: ../?/profile/error/1");

	} else if($newpass != $checkpass) {
			header("Location: ../?/profile/error/2");


		} else {

		$shapass = sha1($oldpass);
		$index = findIndexByName($r, $user, 0);
		$newshapass = sha1($newpass);
		if ($shapass == $r[$index][1]) {

			$result = mysql_query("UPDATE  `yc2`.`users` SET  `password` =  '$newshapass' WHERE `users`.`username` =  '$user' AND `users`.`password` =  '$shapass';", $dbconnect) or die(mysql_error());

		} else {
			header("Location: ../?/profile/error/3");

		}


	}
}
function addtobeta($mail, $dbconnect) {


	if(!$mail) {
		die('<META HTTP-EQUIV="Refresh" Content="0; URL=../?/register/error/1">');
	} else {

		if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {

			mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

			$result = mysql_query("INSERT INTO invites (mail, invited) VALUES('$mail', 0);", $dbconnect) or die(mysql_error());
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/register/done">';
		} else {
			die('<META HTTP-EQUIV="Refresh" Content="0; URL=../?/register/error/2">');
		}

	}
}

function is_valid_email ($email)
{
	$qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
	$dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
	$atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
		'\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
	$quoted_pair = '\\x5c\\x00-\\x7f';
	$domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
	$quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
	$domain_ref = $atom;
	$sub_domain = "($domain_ref|$domain_literal)";
	$word = "($atom|$quoted_string)";
	$domain = "$sub_domain(\\x2e$sub_domain)*";
	$local_part = "$word(\\x2e$word)*";
	$addr_spec = "$local_part\\x40$domain";

	return preg_match("!^$addr_spec$!", $email) ? true : false;
}

function getInvites($dbconnect) {



	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

	$result = mysql_query("SELECT * FROM invites", $dbconnect) or die(mysql_error());

	while($r[]=mysql_fetch_row($result));


	return $r;
	//header('Location: ./frontend/?/profile');

	//echo "yep";


}
function getDirectorySize($path)
{
	$totalsize = 0;
	$totalcount = 0;
	$dircount = 0;
	if ($handle = opendir($path))
	{
		while (false !== ($file = readdir($handle)))
		{
			$nextpath = $path . '/' . $file;
			if ($file != '.' && $file != '..' && !is_link($nextpath))
			{
				if (is_dir($nextpath))
				{
					$dircount++;
					$result = getDirectorySize($nextpath);
					$totalsize += $result['size'];
					$totalcount += $result['count'];
					$dircount += $result['dircount'];
				}
				elseif (is_file($nextpath))
				{
					$totalsize += filesize($nextpath);
					$totalcount++;
				}
			}
		}
	}
	closedir($handle);
	$total['size'] = $totalsize;
	$total['count'] = $totalcount;
	$total['dircount'] = $dircount;
	return $total;
}

function convert_from_bytes( $bytes, $to=NULL )
{
	$float = floatval( $bytes );
	switch( $to )
	{
	case 'Kb' :            // Kilobit
		$float = ( $float*8 ) / 1024;
		break;
	case 'b' :             // bit
		$float *= 8;
		break;
	case 'GB' :            // Gigabyte
		$float /= 1024;
	case 'MB' :            // Megabyte
		$float /= 1024;
	case 'KB' :            // Kilobyte
		$float /= 1024;
	default :              // byte
	}
	unset( $bytes, $to );
	return( round($float, 2) );
}
function file_extension($filename)
{
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}

function encrypt($sData, $sKey){
	$sResult = '';
	for($i=0;$i<strlen($sData);$i++){
		$sChar    = substr($sData, $i, 1);
		$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
		$sChar    = chr(ord($sChar) + ord($sKeyChar));
		$sResult .= $sChar;
	}
	return encode_base64($sResult);
}

function decrypt($sData, $sKey){
	$sResult = '';
	$sData   = decode_base64($sData);
	for($i=0;$i<strlen($sData);$i++){
		$sChar    = substr($sData, $i, 1);
		$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
		$sChar    = chr(ord($sChar) - ord($sKeyChar));
		$sResult .= $sChar;
	}
	return $sResult;
}
function encode_base64($sData){
	$sBase64 = base64_encode($sData);
	return strtr($sBase64, '+/', '-_');
}

function decode_base64($sData){
	$sBase64 = strtr($sData, '-_', '+/');
	return base64_decode($sBase64);
}
function getDirectoryList($directory)
{

	// create an array to hold directory list
	$results = array();

	// create a handler for the directory
	$handler = opendir($directory);

	// open directory and walk through the filenames
	while ($file = readdir($handler)) {

		// if file isn't this directory or its parent, add it to the results
		if ($file != "." && $file != "..") {
			$results[] = $file;
		}

	}

	// tidy up: close the handler
	closedir($handler);

	if (in_array(".DS_Store", $results)) {
		$results = remove_item_by_value($results, ".DS_Store");
	}
	if (in_array("index.php", $results)) {
		$results = remove_item_by_value($results, "index.php");
	}
	/*if (in_array("Thefile", $results)) {
  		$results = remove_item_by_value($results, "Thefile");
 	}*/ //for blacklisting a file
	if (in_array("POSTTEMPLATE", $results)) {
		$results = remove_item_by_value($results, "POSTTEMPLATE");
	}
	// done!
	return $results;


}
function parse($value, $string=false) {
	if($string) {
		$lines = explode("\r\n", $value);
	} else {
		$lines = file($value);
	}
	$content = array();
	foreach ($lines as $line) {
		$posColon = strpos($line, ":");
		$tag = strtolower(substr($line, 0, $posColon));
		$body = substr($line, $posColon+1);

		$content[$tag] = trim($body);
	}
	return array_filter($content);
}
function remove_item_by_value($array, $val = '', $preserve_keys = true)
{
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;

	foreach ($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}

	return ($preserve_keys === true) ? $array : array_values($array);
}
function genRandomString() {
	$length = 10;
	$characters = ’0123456789abcdefghijklmnopqrstuvwxyz’;
	$string = ”;
	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters))];
	}
	return $string;
}
?>
