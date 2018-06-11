<?php

	$user = $_POST["user"];
	$psw = $_POST["psw"];

	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");
	$userQuery = 'SELECT count(*) from usuarios WHERE nombre=\''.$user.'\' and psw=\''.md5($psw).'\'';

	$result = pg_query($userQuery);
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);

	echo $line["count"];

	pg_free_result($result);
	pg_close($dbcon);

?>