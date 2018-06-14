<?php

	$psw = $_POST["psw"];
	$guid = $_POST["guid"];

	$where = 'WHERE guid=\''.$guid.'\'';
	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");

	$insertQuery = 'UPDATE usuarios SET psw=\''.$psw.'\''.$where;

	$result = pg_query($userQuery);
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);

	echo "{\"count\":\"".$line["count"]."\", \"guid\":\"".$guid."\"}";

	pg_free_result($result);
	pg_close($dbcon);

?>