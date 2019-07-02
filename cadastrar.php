	<?php

		session_start();
		include_once("db.php");

		if (isset($_POST['entrar'])) {
			$nome=$_POST['nome'];
			$apelido=$_POST['apelido'];
			$email=$_POST['email'];
			$password=$_POST['pass'];
			$data=date("Y/m/d");

			$email_check=mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
			$do_email_check=mysqli_num_rows($email_check);
			if ($do_email_check>=1) {
				echo '<h3>O email colocado ja existe</h3>';
			
			} else
			if ($nome =='' or strlen($nome)<3) {
				echo "<h3> escreva o teu nome correctamente!</h3>";
				# code...
			}elseif ($email =='' or strlen($email)<10) {
				echo "<h3> escreva o teu email correctamente!</h3>";
			} elseif ($password =='' or strlen($password)<6) {
				echo "<h3> escreva o teu password correctamente!</h3>";
			} else {
				$query= "INSERT INTO users(nome,apelido,email,password,data) VALUES ('$nome','$apelido','$email','$password','$data')";
				$result=mysqli_query($connect,$query) or die ("houve um problema ao inserir os dados");
				if ($result) {
					setcookie("login",$email);
					header("location: index.php");
				} else{
					echo "<h3>Desculpa, houve um erro ao registrar-te...</h3>";
				}
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
		<img src="img/icylogo1.jpg"><br />
		<h2>Crie a sua conta</h2>
		<form method="POST">
			<input type="text" placeholder="nome" name="nome" id="nome"><br />
			<input type="text" placeholder="apelido" name="apelido" id="apelido"> <br />
			<input type="email" placeholder="Endereco email ou contacto" name="email" id="email"><br />
			<input type="password" placeholder="password" name="pass" id="pass"><br  />
			<input type="submit" value="Criar conta" name="entrar" id="entrar">
		</form>
		<h3>Já tens uma conta? <a href="login.php">Entre aqui!</a></h3>
	</body>
	</html>