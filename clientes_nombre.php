<?php

	include("conexion.php");
	$id = $_GET['id']; 
	$sql = "Select nombre from clientes where id_cliente=$id";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row)
	{
		$nombre = $row['nombre'];
		echo "$nombre";
	}

?>