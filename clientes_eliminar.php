<?php
	include("conexion.php");
	if(isset($_POST['submit_eliminar']))
	{
		if(!empty($_POST['check_list'])) 
		{
			// Counting number of checked checkboxes.
			$checked_count = count($_POST['check_list']);
			//echo " <br/>Se han eliminado ".$checked_count." registros(s):";
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected) 
			{
				echo "<br/>$selected";
				$sql="delete from clientes where Id_Cliente=$selected";
				$conn->query($sql);
				//header('Location: http://localhost/PHP/clientes.php');
				?>
					<script type="text/javascript">
						window.location.href = 'http://localhost/PHP/clientes.php';
					</script>
				<?php
			}
		}
		else
		{
			echo "<b>Selecione al menos un cliente para eliminar.</b>";
		}
	}
	if(isset($_POST['submit_modificar']))
	{
		if (is_uploaded_file($_FILES['foto']['tmp_name']))
		{
			$foto=$_FILES['foto']['tmp_name'];
			// Tratamiento necesario para introducir la imagen en la base de datos
			ini_set("gd.jpeg_ignore_warning", 1);
			$fotografia=imagecreatefromjpeg($foto);
			ob_start(); // abrimos el buffer interno
			imagejpeg($fotografia);
			// obtenemos el fichero jpg-binario del buffer y lo almacena en la variable jpg
			$jpg=ob_get_contents();
			//cerramos el buffer
			ob_end_clean();
			// preparamos la variable para usarla en una consulta sql
			$jpg=str_replace('##','\##',mysql_real_escape_string($jpg));
				echo "foto nueva";
				echo "<br><br>";
		}
		else
		{
			if($_SESSION['imagen'])
			{
				$jpg=$imagen;
				echo "foto vieja";
				echo "<br><br>";
			}
			else
			{
				$jpg='';
				echo "sin foto";
				echo "<br><br>";
			}
		}

		//$sql = "update clientes set DNI='" .$_POST['dni']. "', Nombre='" .$_POST['nombre']. "', Apellido1='" .$_POST['apellido1']. "', Apellido2='" .$_POST['apellido2'].  "', Direccion='" .$_POST['direccion']. "', CP='" .$_POST['cp']. "', Poblacion='" .$_POST['poblacion']. "', Provincia='" .$_POST['provincia']. "', Telefono='" .$_POST['tlf']. "', `E-mail`='" .$_POST['mail']. "', Fotografia='" .$jpg. "' where id_cliente=" .$_POST['id_c'];
		$sql = "update clientes set DNI='" .$_POST['dni']. "', Nombre='" .$_POST['nombre']. "', Apellido1='" .$_POST['apellido1']. "', Apellido2='" .$_POST['apellido2'].  "', Direccion='" .$_POST['direccion']. "', CP='" .$_POST['cp']. "', Poblacion='" .$_POST['poblacion']. "', Provincia='" .$_POST['provincia']. "', Telefono='" .$_POST['tlf']. "', `E-mail`='" .$_POST['mail']. "' where id_cliente=" .$_POST['id_c'];
		//echo $sql;
		$conn->query($sql);
		echo "<br/> Se ha modificado el registro";
		
		/*echo $_POST['dni'];
		echo $_POST['nombre'];
		echo $_POST['apellido1'];
		echo $_POST['apellido2'];
		echo $_POST['direccion'];
		echo $_POST['cp'];
		echo $_POST['poblacion'];
		echo $_POST['provincia'];
		echo $_POST['tlf'];
		echo $_POST['mail'];*/

		
		header('Location: http://localhost/PHP/clientes.php');
	}
	
	$conn=null;	
?>
