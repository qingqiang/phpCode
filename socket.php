<?php
function asyn_sendmail() {
	$fp = fsockopen("localhost", 80, $errno, $errstr, 30);
	if(!$fp){
		echo "$errstr ($errno)<br />\n";
	}
	
	fputs($fp,"GET http://localhost/socket/sendmail.php\r\n");
	fclose($fp);
}

echo time().'';
echo 'call asyn_sendmail';
asyn_sendmail();
echo time().'';