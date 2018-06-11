<?php

	$user = $_POST["user"];
	$psw = $_POST["psw"];

	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");

	$userQuery = 'SELECT count(*) from usuarios WHERE nombre=\''.$user.'\';';
	$userResult = pg_query($userQuery);
	$line = pg_fetch_array($userResult, null, PGSQL_ASSOC);

	if($line["count"] != 0){
		echo $line["count"];
		pg_free_result($userResult);
	}
	else{
		$insertQuery = 'INSERT INTO usuarios VALUES (nextval(\'user_id_seq\'),\''.$user.'\', \''.md5($psw).'\')';

		$result = pg_query($dbcon, $insertQuery);
		pg_free_result($result);

	}

	pg_close($dbcon);

?>