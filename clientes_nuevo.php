<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">

	<head>
		<title>Gestión de Embarcaciones</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	
	<?php
		include("logeado.php");
		include("conexion.php");
		$sql = "SELECT max(id_cliente) as max FROM clientes";

		$result = $conn->query($sql);
		if ($result->rowCount() > 0) 
		{
			$rows = $result->fetchAll();
			foreach ($rows as $row)
			{ 
				$max = $row['max']+1;
			}
		}
	?>
	
	<body>
		<h1>Nuevo Cliente</h1>
		
		<hr/>
		
		
		<form action="clientes_nuevo.php" method="post">
		
			<table id=tClientes border=2>
			
				<thead>
					<tr><th>ID</th><th>DNI</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Dirección</th><th>CP</th><th>Población</th><th>Provincia</th><th>Tlf</th><th>E-mail</th><th>Fotografía</th></tr>
				</thead>
				
				<tbody>
					<tr>
						<td><input name=id_c readonly value=<?php echo $max ?> size=10></td>
						<td><input name=dni type=text size=9 value=DNI></td>
						<td><input name=nombre type=text size=10 value=nombre></td>
						<td><input name=apellido1 type=text size=10 value=apellido1></td>
						<td><input name=apellido2 type=text size=10 value=apellido2></td>
						<td><input name=direccion type=text size=10 value=direccion></td>
						<td><input name=cp type=text size=5 value=cp></td>
						<td><input name=poblacion type=text size=10 value=poblacion></td>
						<td><input name=provincia type=text size=10 value=provincia></td>
						<td><input name=tlf type=text size=9 value=960123456></td>
						<td><input name=mail type=text value=mail></td>
						<td>Sin Foto</td>
					</tr>
				</tbody>
			</table>
			
		<br><br>
		<input type=file name=foto Value="Seleccionar imagen" accept="image/*" />
		<br><br>
		<input type="submit" name="submit_nuevo" Value="Registrar"/>
		</form>
			
		<?php
			include("clientes_nuevo_ok.php");
		?>
			
		<br><br>
		<hr/>
		<a href=clientes.php>Gestión de Clientes</a>
		<br><br>
		<a href=indice.php>Panel de Control</a>
		<br><br>
		<?php echo $_SESSION['username'] ?>
		<br>
		<a href=logout.php> Cerrar Sesión </a>
	</body>
</html>
