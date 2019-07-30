<?php
	include("header.php");

	$pubs = mysql_query("SELECT
			T.id, 
		    T.user, 
		    T.texto, 
		    T.imagem, 
		    T.data,
		    U.de,
		    U.para, 
		    U.aceite
		 FROM
		    pubs AS T,
		    amizades AS U 
		 WHERE
		    T.user = U.de AND U.para = '$login_cookie' AND U.aceite='sim'
		    OR T.user = U.para AND U.de = '$login_cookie' AND U.aceite='sim'
		    order by T.id DESC;");

	if (isset($_POST['publish'])) {
		if ($_FILES["file"]["error"] > 0) {
			$texto = $_POST["texto"];
			$hoje = date("Y-m-d");

			if ($texto == "") {
				echo "<h3>Tens de escrever alguma coisa antes de publicar!</h3>";
			}else{
				$query = "INSERT INTO pubs (user,texto,data) VALUES ('$login_cookie','$texto','$hoje')";
				$data = mysql_query($query) or die();
				if ($data) {
					header("Location: ./");
				}else{
					echo "Alguma coisa não correu lá muito bem... Tenta outra vez mais tarde";
				}
			}
		}else{
			$n = rand(0, 1000000);
			$img = $n.$_FILES["file"]["name"];

			move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/".$img);

			$texto = $_POST['texto'];
			$hoje = date("Y-m-d");

			if ($texto == "") {
				echo "<h3>Tens de escrever alguma coisa antes de publicar!</h3>";
			}else{
				$query = "INSERT INTO pubs (user,texto,imagem,data) VALUES ('$login_cookie','$texto','$img','$hoje')";
				$data = mysql_query($query) or die();
				if ($data) {
					header("Location: ./");
				}else{
					echo "Alguma coisa não correu lá muito bem... Tenta outra vez mais tarde";
				}
			}
		}
	}

	if (isset($_GET["love"])) {
		love();
	}

	function love() {
		$login_cookie = $_COOKIE['login'];
		$publicacaoid = $_GET['love'];
		$data = date("Y/m/d");

		$post = mysql_query("SELECT * FROM pubs WHERE id='$publicacaoid'");
		$postinfo = mysql_fetch_assoc($post);
		$userinfo = $postinfo['user'];

		$ins = "INSERT INTO loves (`user`,`pub`,`date`) VALUES ('$login_cookie','$publicacaoid','$data')";
		$conf = mysql_query($ins) or die(mysql_error());
		if ($conf) {
			$not = mysql_query("INSERT INTO notificacoes (`userde`,`userpara`,`tipo`,`post`,`data`) VALUES ('$login_cookie','$userinfo','1','$publicacaoid','$data')");
			header("Location: index.php#".$publicacaoid);
		}else{
			echo "<h3>Erro</h3> ".mysql_error();
		}
	}

	if (isset($_GET["unlove"])) {
		unlove();
	}

	function unlove() {
		$login_cookie = $_COOKIE['login'];
		$publicacaoid = $_GET['unlove'];
		$data = date("Y/m/d");

		$del = "DELETE FROM loves WHERE `user`='$login_cookie' AND `pub`='$publicacaoid'";
		$conf = mysql_query($del) or die(mysql_error());
		if ($conf) {
			header("Location: index.php#".$publicacaoid);
		}else{
			echo "<h3>Erro</h3> ".mysql_error();
		}
	}
?>
<html>
<header>
	<style type="text/css">
	div#publish{width: 90%; max-width: 400px; height: 210px; display: block; margin: auto; border: none; border-radius: 5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div#publish textarea{width: 90%; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1;}
	div#publish img{margin-top: 0px; margin-left: 10px; width: 40px; cursor: pointer;}
	div#publish input[type="submit"]{width: 70px; height: 25px; border-radius: 3px; float: right; margin-right: 15px; border: none; margin-top: 5px; background: #4169E1; color: #FFF; cursor: pointer;}
	div#publish input[type="submit"]:hover{background: #001F3F;}

	div.pub{width: 90%; max-width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div.pub a{color: #666; text-decoration: none;}
	div.pub a:hover{color: #111; text-decoration: none;}
	div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
	div.pub span{display: block; margin: auto; width: 90%; margin-top: 10px; margin-left: 10px; }
	div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}

	div#love{width: 90%; max-width: 400px; height: 30px; display: block; margin: auto; border: none; border-radius: 5px; background: #007fff; margin-top: 5px;}
	div#love p{color: #FFF; font-size: 12px; padding-top: 5px; padding-left: 5px;}
	div#love a{color: #FFF; font-size: 16px; text-decoration: none;}
	#comentar{
		float: right;
		margin-top: 15px;
		margin-right: 15px;
		cursor: pointer;
		width: 13px;
	}
	</style>
</header>
<body>
	<div id="publish">
		<form method="POST" enctype="multipart/form-data">
			<br />
			<textarea placeholder="Escreve uma publicacão nova" name="texto"></textarea>
			<label for="file-input">
				<img src="../img/imagegrey.png" title="Inserir uma fotografia" />
			</label>
			<input type="submit" value="Publicar" name="publish" />

			<input type="file" id="file-input" name="file" hidden />
		</form>
	</div>
	<?php
		while ($pub=mysql_fetch_assoc($pubs)) {
			$email = $pub['user'];
			$saberr = mysql_query("SELECT * FROM users WHERE email='$email'");
			$saber = mysql_fetch_assoc($saberr);
			$nome = $saber['nome']." ".$saber['apelido'];
			$id = $pub['id'];
			$saberloves = mysql_query("SELECT * FROM loves WHERE pub='$id'");
			$loves = mysql_num_rows($saberloves);

			if ($pub['imagem']=="") {
				echo '<div class="pub" id="'.$id.'">
					<a href="comentarios.php?id='.$id.'"><img id="comentar" src="../img/chat.png" width="13" ></a>
					<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
					<span>'.$pub['texto'].'</span><br />
				</div>
				<div id="love">';
				$email_check = mysql_query("SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'");
				$do_email_check = mysql_num_rows($email_check);
				if ($do_email_check >= 1) {
					$loves = $loves - 1;
					echo '<p><a href="index.php?unlove='.$id.'">Gostei</a> | Tu e mais '.$loves.' gostaram disto</p>';
				}else{
					echo '<p><a href="index.php?love='.$id.'">Gostar</a> | '.$loves.' gostaram disto</p>';
				}
				echo '</div>';
			}else{
				echo '<div class="pub" id="'.$id.'">
					<a href="comentarios.php?id='.$id.'"><img id="comentar" src="../img/chat.png" width="13" ></a>
					<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
					<span>'.$pub['texto'].'</span>
					<img src="../upload/'.$pub["imagem"].'" />
				</div>
				<div id="love">';
				$email_check = mysql_query("SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'");
				$do_email_check = mysql_num_rows($email_check);
				if ($do_email_check >= 1) {
					$loves = $loves - 1;
					echo '<p><a href="index.php?unlove='.$id.'">Gostei</a> | Tu e mais '.$loves.' gostaram disto</p>';
				}else{
					echo '<p><a href="index.php?love='.$id.'">Gostar</a> | '.$loves.' gostaram disto</p>';
				}
				echo '</div>';
			}
		}
	?>
	<br />
	<div id="footer"><p>&copy; Meet new Friends, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>