	<?php
	$host="localhost";
	$dbuser="root";
	$dbpwd="";
	$connect = mysqli_connect($host, $dbuser, $dbpwd) or die ("Nao conectou a base de dados");
			$select = mysqli_select_db ($connect,"aula-rede-social");
	?>
	 