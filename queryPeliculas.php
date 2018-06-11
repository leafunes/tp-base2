<?php
	$dbcon = pg_connect("host=localhost dbname=tp user=postgres
		port=5434");
	$userQuery = 'SELECT u1.nombre as nombre1, u2.nombre as nombre2 from usuarios as u1 inner join usuarios as u2 on u1.id != u2.id where not exists (SELECT  p3.id_peli from pelis_que_vio as p3 where p3.id_usuario = u1.id or p3.id_usuario = u2.id except( SELECT p1.id_peli from pelis_que_vio as p1 where p1.id_usuario = u1.id INTERSECT SELECT p2.id_peli from pelis_que_vio as p2 where p2.id_usuario = u2.id )) and u1.id < u2.id';

	$result = pg_query($userQuery);

	$json = '[';
	while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){

		$json = $json."{\"nombre1\": \"".$line['nombre1']."\", \"nombre2\": \"".$line['nombre2']."\"},";

	};

	$json = substr($json, 0, $json.lenght -1 ).']';

	pg_free_result($result);
	pg_close($dbcon);

	echo $json;

?>