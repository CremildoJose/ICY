	<?php
	 include("db.php");
	 if (isset($_POST['entrar'])){
	 	$email=$_POST['email'];
	 	$password=$_POST['password'];
	 	$verifica=mysqli_query("SELECT * FROM users WHERE email='$email' AND password='$password'" );
	 	if(mysqli_num_rows($verifica<=0)){
	 		echo "<h3>email ou password incorrectos!</h3>";
	 	} else{
	 		setcookie("login",$email);
	 		header("location: index.php");
	 		
	 	}
	 }
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Bem vindo ao ICY</title>
		<link rel="stylesheet" type="text/css" href="css\css.css">
	</head>
	<body>
		<img src="img/icylogo1.jpg">
		<h2>Entre na sua conta</h2>
		<form method="POST">
			<input type="email" placeholder="Endereco email ou contacto" name="email"><br />
			<input type="password" placeholder="password" name="password"><br  />
			<input type="submit" value="entrar" name="entrar">
		</form>
		<h3>Ainda não tens conta? <a href="cadastrar.php">Crie agora!</a></h3>
	</body>
	</html>