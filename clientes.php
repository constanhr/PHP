<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">

	<head>
		<title>Gestión de Clientes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	
	<body>
		<h1>Gestión de Clientes</h1>
		<hr/>
		
		<h3>Parámetros de búsqueda</h3>
	
		<form action="clientes.php" method="post">
		
	<?php
		include("logeado.php");
		include("conexion.php");
		
		echo "<table id=tClientesLis border=2><thead>";
			echo "<tr><th>DNI</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th>
				<th>Dirección</th><th>CP</th><th>Población</th><th>Provincia</th><th>Tlf</th>
				<th>E-mail</th></tr></thead><tbody>";
			
		echo "<tr>";
			echo "<td><input name=dnilis type=text size=9 ></td>";
			echo "<td><input name=nombrelis type=text size=10 ></td>";
			echo "<td><input name=apellido1lis type=text size=10 ></td>";
			echo "<td><input name=apellido2lis type=text size=10 ></td>";
			echo "<td><input name=direccionlis type=text size=10 ></td>";
			echo "<td><input name=cplis type=text size=5 ></td>";
			echo "<td><input name=poblacionlis type=text size=10 ></td>";
			echo "<td><input name=provincialis type=text size=10 ></td>";
			echo "<td><input name=tlflis type=text size=9 ></td>";
			echo "<td><input name=maillis type=text ></td>";
		echo "</tr>";
	
		echo "</tbody></table>";
		echo "<br>";
		echo "<br>";
		
		$_SESSION['cli_id'] = -1;
		 
		//$sql = "SELECT * FROM clientes";
		//$sql = "SELECT * FROM clientes order by Apellido1, Apellido2, Nombre ASC";
		

		$busqueda=false;
		
		if(isset($_POST['dnilis']) && $_POST['dnilis']!="")
		{
			$busqueda=true;
			$where[] = "dni LIKE '%".$_POST['dnilis']."%'";
		}
		if(isset($_POST['nombrelis']) && $_POST['nombrelis']!="")
		{
			$busqueda=true;
			$where[] = "nombre LIKE '%".$_POST['nombrelis']."%'";
		}
		if(isset($_POST['apellido1lis']) && $_POST['apellido1lis']!="")
		{
			$busqueda=true;
			$where[] = "apellido1 LIKE '%".$_POST['apellido1lis']."%'";			
		}
		if(isset($_POST['apellido2lis']) && $_POST['apellido2lis']!="")
		{
			$busqueda=true;
			$where[] = "apellido2 LIKE '%".$_POST['apellido2lis']."%'";	
		}
		if(isset($_POST['direccionlis']) && $_POST['direccionlis']!="")
		{
			$busqueda=true;
			$where[] = "direccion LIKE '%".$_POST['direccionlis']."%'";	
		}
		if(isset($_POST['cplis']) && $_POST['cplis']!="")
		{
			$busqueda=true;
			$where[] = "cp LIKE '%".$_POST['cplis']."%'";
		}
		if(isset($_POST['poblacionlis']) && $_POST['poblacionlis']!="")
		{
			$busqueda=true;
			$where[] = "poblacion LIKE '%".$_POST['poblacionlis']."%'";
		}
		if(isset($_POST['provincialis']) && $_POST['provincialis']!="")
		{
			$busqueda=true;
			$where[] = "provincia LIKE '%".$_POST['provincialis']."%'";	
		}
		if(isset($_POST['tlflis']) && $_POST['tlflis']!="")
		{
			$busqueda=true;
			$where[] = "Telefono LIKE '%".$_POST['tlflis']."%'";	
		}
		if(isset($_POST['maillis']) && $_POST['maillis']!="")
		{
			$busqueda=true;
			$where[] = "`E-mail` LIKE '%".$_POST['maillis']."%'";	
		}
		
		if($busqueda==true)
		{
			$sql = "SELECT * FROM clientes WHERE ".implode(" AND ",$where);
		}
		else
		{
			$sql = "SELECT * FROM clientes";
		}
		$result = $conn->query($sql);
		
		$busqueda=false;
		echo $sql;

		echo "<table id=tClientes border=2><thead>";
		echo "<tr><th>ID</th><th>DNI</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th>
			<th>Dirección</th><th>CP</th><th>Población</th><th>Provincia</th><th>Tlf</th>
			<th>E-mail</th><th>Fotografía</th><th>Eliminar</th></tr></thead><tbody>";
		if ($result->rowCount() > 0) 
		{
			$rows = $result->fetchAll();
			foreach ($rows as $row)
			{
				$ID = $row['Id_Cliente'];
				$DNI = $row['DNI'];
				$nombre = $row['Nombre'];
				$apellido1 = $row['Apellido1'];
				$apellido2 = $row['Apellido2'];
				$direccion = $row['Direccion'];
				$cp = $row['CP'];
				$poblacion = $row['Poblacion'];
				$provincia = $row['Provincia'];
				$tlf = $row['Telefono'];
				$mail = $row['E-mail'];
				$foto = $row['Fotografia'];
				
				echo "<tr style=cursor:pointer>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$ID</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$DNI</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$nombre</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$apellido1</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$apellido2</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$direccion</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$cp</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$poblacion</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$provincia</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$tlf</td>";
				echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>$mail</td>";
				if($foto == '')
				{
					echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>Sin Foto</td>"; 
				}
				else
				{
					$imagen=basename(tempnam(getcwd(),"temp")); 
					$imagen.=".jpg";
					$fichero=fopen($imagen,"w");
					fwrite($fichero,$foto);
					fclose($fichero);
					echo "<td onclick=document.location='clientes_detalles.php?id=$ID'><img src=$imagen width=100 height=100 /></td>"; 
				}
				//echo "<td onclick=document.location='clientes_detalles.php?id=$ID'><img src=blob.php?id=$ID alt=Img /></td>"; 
				echo "<td><input type=checkbox name=check_list[] value=$ID>$ID</td>"; 
				echo "</tr>";
			}
			echo "</tbody></table>";
		}
		else 
		{ 
			echo "No hay clientes en la base de datos";
			echo "<br><a href='indice.php'>Menú principal</a>";
		}
		$conn = null;
	?>
			
			
			</tbody>
		</table>
		
		<br><br>
		<input type="submit" name="submit_filtrar" Value="Filtrar"/>
		<input type="submit" name="submit_eliminar" Value="Eliminar"/>
		<input type="button" value="Nuevo" onclick="window.location='clientes_nuevo.php'">
		
		</form>
	<?php
		include ("clientes_eliminar.php");
	?>
		<br><br>
		<hr/>
		<a href=indice.php>Panel de Control</a>
		<br><br>
		<?php echo $_SESSION['username'] ?>
		<br>
		<a href=logout.php> Cerrar Sesión </a>
	</body>
</html>
