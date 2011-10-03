<?php

$payload = json_decode(stripslashes($_POST['payload']));

$password = "ULTRAmegaHIPERsuperdifficultpassword18365385937267--..,.--,-..,-";

if($_GET['pass'] == sha1($password)) {
	if($payload->ref === 'refs/heads/master') {

		fwrite(fopen('./extra/logs/github.txt', 'a'), "(".date("d/m/Y")." - ".date("h:m:s").") NEW COMMIT => ".$payload->commits[0]->message."\n");
		echo shell_exec('git pull');
	} else {
		fwrite(fopen('./extra/logs/github.txt', 'a'), "(".date("d/m/Y")." - ".date("h:m:s").") UNKNOWN BRAND => ".$payload->ref."\n");


	}
	
} else {
	fwrite(fopen('./extra/logs/github.txt', 'a'), "(".date("d/m/Y")." - ".date("h:m:s").") WRONG GET KEY\n");


}
?>
