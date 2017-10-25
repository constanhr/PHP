<?php
	include("conexion.php");
	if(isset($_POST['submit_nuevo']))
	{
		$sql = "insert into clientes values (" .$_POST['id_c']. ", '" .$_POST['dni']. "', '" .$_POST['nombre']. "', '" .$_POST['apellido1']. "', '" .$_POST['apellido2'].  "', '" .$_POST['direccion']. "', '" .$_POST['cp']. "', '" .$_POST['poblacion']. "', '" .$_POST['provincia']. "', " .$_POST['tlf']. ", '" .$_POST['mail']. "', '') ";
		echo $sql;
		$conn->query($sql);
		echo "<br/> Se ha añadido el registro";

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
?>
		<script type="text/javascript">
			window.location.href = 'http://localhost/PHP/clientes.php';
		</script>
		<?php
				//header('Location: http://localhost/PHP/clientes.php');
	}
	$conn=null;
?>