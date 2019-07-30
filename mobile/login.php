<?php
	include("../db.php");

	if (isset($_POST['entrar'])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$verifica = mysql_query("SELECT * FROM users WHERE email = '$email' AND password='$pass'");
		if (mysql_num_rows($verifica)<=0) {
			echo "<h3>Palavra-passe ou e-mail errados!</h3>";
		}else{
			setcookie("login",$email);
			header("location: ./");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<style type="text/css">
	*{font-family: 'Montserrat', cursive;}
	img{display: block; margin: auto; margin-top: 20px; width: 200px;}
	form{text-align: center; margin-top: 20px;}
	input[type="email"]{border: 1px solid #CCC; width: 250px; height: 30px; padding-left: 10px; border-radius: 3px;}
	input[type="password"]{border: 1px solid #CCC; width: 250px; height: 30px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
	input[type="submit"]{border: none; width: 80px; height: 40px; margin-top: 20px; border-radius: 3px; font-size: 14pt;}
	input[type="submit"]:hover{background-color: #1E90FF; color: #FFF; cursor: pointer;}
	h2{text-align: center; margin-top: 20px;}
	h3{text-align: center; color: #1E90FF; margin-top: 15px;}
	a{text-decoration: none; color: #333;}
	</style>
</head>
<body>
	<img src="../img/logo.png"><br />
	<h2>Entra na tua conta</h2>
	<form method="POST">
		<input type="email" placeholder="Endereço email" name="email"><br />
		<input type="password" placeholder="Palavra-passe" name="pass"><br />
		<input type="submit" value="Entrar" name="entrar">
	</form>
	<h3>Ainda não tens conta? <a href="registar.php">Cria uma hoje!</a></h3>
</body>
</html>