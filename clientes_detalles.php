<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">

	<head>
		<title>Detalles de Clientes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	
	<body>
		<h1>Detalles del Cliente</h1>
		<hr/>
		

		<form action="clientes_detalles.php" method="post" enctype="multipart/form-data">
	<?php
	
		include("logeado.php");
		include("conexion.php");
		
		
			if(isset($_GET['id']))
			{ 
				$id = $_GET['id']; 

			} 
			else 
			{
				if($_SESSION['cli_id']!=-1)
					$id = $_SESSION['cli_id'];
				//echo 'Seleccione un ID para visulizar su ficha'; 
			} 	
			
			//echo "Mostrando detalles para el id $id";
		
			$sql = "SELECT * FROM clientes where Id_Cliente=$id";

			$result = $conn->query($sql);


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
					
					echo "<tr>";
					echo "<td><input name=id_c readonly value=$ID size=10></td>";
					echo "<td><input name=dni type=text size=9 value=$DNI></td>";
					echo "<td><input name=nombre type=text size=10 value=$nombre></td>";
					echo "<td><input name=apellido1 type=text size=10 value=$apellido1></td>";
					echo "<td><input name=apellido2 type=text size=10 value=$apellido2></td>";
					echo "<td><input name=direccion type=text size=10 value=$direccion></td>";
					echo "<td><input name=cp type=text size=5 value=$cp></td>";
					echo "<td><input name=poblacion type=text size=10 value=$poblacion></td>";
					echo "<td><input name=provincia type=text size=10 value=$provincia></td>";
					echo "<td><input name=tlf type=text size=9 value=$tlf></td>";
					echo "<td><input name=mail type=text value=$mail></td>";
					if($foto == '')
					{
						echo "<td onclick=document.location='clientes_detalles.php?id=$ID'>Sin Foto</td>"; 
						$_SESSION['imagen']=false;
					}
					else
					{
						$imagen=basename(tempnam(getcwd(),"temp")); 
						$imagen.=".jpg";
						$fichero=fopen($imagen,"w");
						fwrite($fichero,$foto);
						fclose($fichero);
						echo "<td onclick=document.location='clientes_detalles.php?id=$ID'><img src=$imagen width=100 height=100 /></td>"; 
						$_SESSION['imagen']=true;
					}
					echo "<td contenteditable><input type=checkbox name=check_list[] value=$ID>$ID</td>"; 
					echo "</tr>";
					$_SESSION['cli_id'] = $ID;
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
			<input type=file name=foto Value="Seleccionar imagen" accept="image/*" />
			<br><br>
			<input type="submit" name="submit_eliminar" Value="Eliminar"/>
			<input type="submit" name="submit_modificar" Value="Guardar"/>
			</form>
	<?php
		include ("clientes_eliminar.php");
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
