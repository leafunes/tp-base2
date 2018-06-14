<?php

	$user = $_POST["user"];
	$psw = $_POST["psw"];
	$guid = bin2hex(openssl_random_pseudo_bytes(16));

	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");

	$userQuery = 'SELECT count(*) from usuarios WHERE nombre=\''.$user.'\';';
	$userResult = pg_query($userQuery);
	$line = pg_fetch_array($userResult, null, PGSQL_ASSOC);

	if($line["count"] != 0){
		echo "{\"count\":".$line["count"]."}";
		pg_free_result($userResult);
	}
	else{
		$insertQuery = 'INSERT INTO usuarios VALUES (nextval(\'user_id_seq\'),\''.$user.'\', \''.md5($psw).'\', \''.$guid.'\')';

		$result = pg_query($dbcon, $insertQuery);
		pg_free_result($result);

		echo "{\"guid\":\"".$guid."\"}";
	}
	pg_close($dbcon);

?>