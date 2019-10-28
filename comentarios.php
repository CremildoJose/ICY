<?php
	include("header.php");
	require_once('db.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}else{
		header("Location: ./");
	}

	$pubs = mysqli_query($connect,"SELECT * FROM comentarios WHERE post='$id'");

	if (isset($_POST['publish'])) {
		$texto = $_POST["texto"];
		$hoje = date("Y-m-d");

		$post = mysqli_query($connect,"SELECT * FROM pubs WHERE id='$id'");
		$postinfo = mysqli_fetch_assoc($post);
		$userinfo = $postinfo['user'];

		if ($texto == "") {
			echo "<h3>Tens de escrever alguma coisa antes de comentar!</h3>";
		}else{
			$query = "INSERT INTO comentarios (user,texto,post,data) VALUES ('$login_cookie','$texto','$id','$hoje')";
			$data = mysqli_query($connect,$query) or die();
			if ($data) {
				$not = mysqli_query($connect,"INSERT INTO notificacoes (`userde`,`userpara`,`tipo`,`post`,`data`) VALUES ('$login_cookie','$userinfo','2','$id','$hoje')");
				header("Location: comentarios.php?id=".$id);
			}else{
				echo "Alguma coisa não correu lá muito bem... Tenta outra vez mais tarde";
			}
		}
	}
?>
<html>
<header>
	<style type="text/css">
	div#publish{width: 400px; height: 170px; display: block; margin: auto; border: none; border-radius: 5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div#publish textarea{width: 365px; height: 100px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1;}
	div#publish input[type="submit"]{width: 90px; height: 30px; border-radius: 3px; float: right; margin-right: 15px; border: none; margin-top: 10px; background: #4169E1; color: #FFF; cursor: pointer;}
	div#publish input[type="submit"]:hover{background: #001F3F;}

	div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div.pub a{color: #666; text-decoration: none;}
	div.pub a:hover{color: #111; text-decoration: none;}
	div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
	div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
	</style>
</header>
<body>
	<div id="publish">
		<form method="POST" enctype="multipart/form-data">
			<br />
			<textarea placeholder="Escreve um comentário para este post..." name="texto"></textarea>
			<input type="submit" value="Comentar" name="publish" />
		</form>
	</div>
	<?php
		while ($pub=mysqli_fetch_assoc($pubs)) {
			$email = $pub['user'];
			$saberr = mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
			$saber = mysqli_fetch_assoc($saberr);
			$nome = $saber['nome']." ".$saber['apelido'];

			echo '<div class="pub">
				<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
				<span>'.$pub['texto'].'</span><br />
			</div>';
		}
	?>
	<br />
	<div id="footer"><p>&copy; ICY, 2019 - Todos os direitos reservados</p></div><br />
</body>
</html>