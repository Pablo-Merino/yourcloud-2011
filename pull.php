<?php

$payload = json_decode(stripslashes($_POST['payload']));

if($payload->ref === 'refs/heads/master') {

	fwrite(fopen('./extra/logs/github.txt', 'a'), "(".date("d/m/Y")." - ".date("h:m:s").") NEW COMMIT => ".$payload->commits[0]->message."\n");
	echo shell_exec('git pull');
	
	
}
?>