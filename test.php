<?php

	$user = $_POST["user"];
	$psw = $_POST["psw"];
	$guid = bin2hex(openssl_random_pseudo_bytes(16));

	$where = 'WHERE nombre=\''.$user.'\' and psw=\''.md5($psw).'\'';
	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");
	$userQuery = 'SELECT count(*) from usuarios '.$where;

	$insertQuery = 'UPDATE usuarios SET guid=\''.$guid.'\''.$where;

	$result = pg_query($userQuery);
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);

	echo "{\"count\":\"".$line["count"]."\", \"guid\":\"".$guid."\"}";

	pg_free_result($result);
	pg_close($dbcon);

?>