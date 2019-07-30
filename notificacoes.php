<?php
	include("header.php");
	require_once('db.php');
	$pubs = mysqli_query($connect,"SELECT * FROM amizades WHERE para='$login_cookie' AND aceite='nao' ORDER BY id desc");
	$notificacoes = mysqli_query($connect,"SELECT * FROM notificacoes WHERE userpara='$login_cookie' ORDER BY id desc");

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$saberr = mysqli_query($connect,"SELECT * FROM users WHERE id='$id'");
		$saber = mysqli_fetch_assoc($saberr);
		$email = $saber['email'];

		$ins = "UPDATE amizades SET `aceite`='sim' WHERE `de`='$email' AND para='$login_cookie'";
		$conf = mysqli_query($connect,$ins) or die(mysqli_error());
		if ($conf) {
			header("Location: notificacoes.php");
		}else{
			echo "<h3>Erro ao aceitar amizade...</h3>";
		}
	}

	if (isset($_GET['remove'])) {
		$id = $_GET['remove'];
		$saberr = mysqli_query($connect,"SELECT * FROM users WHERE id='$id'");
		$saber = mysqli_fetch_assoc($saberr);
		$email = $saber['email'];

		$ins = "DELETE FROM amizades WHERE `de`='$login_cookie' AND para='$email' OR `para`='$login_cookie' AND de='$email'";
		$conf = mysqli_query($connect,$ins) or die(mysqli_error());
		if ($conf) {
			header("Location: notificacoes.php");
		}else{
			echo "<h3>Erro ao eliminar amizade...</h3>";
		}
	}
?>
<html>
<header>
	<style type="text/css">
	h3{text-align: center; color: #007fff;}
	div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px; text-align: center;}
	div.pub a{color: #666; text-decoration: none;}
	div.pub a:hover{color: #111; text-decoration: none;}
	div.pub p{content: #666; text-align: center;}
	div.pub span{display: block; margin: auto; padding-top: 20px; text-align: center;}
	div.pub input{border-radius: 3px; background-color: #007fff; border: none; color: #FFF; height: 25px; padding-right: 5px; padding-left: 5px; cursor: pointer;}
	div.pub input:hover{background-color: #FFF; color: #007fff;}

	div.not{width: 400px; height: 70px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; text-align: center;}
	div.not a{color: #666; text-decoration: none; position: relative; top: 40%;}
	div.not a:hover{color: #111; text-decoration: none;}
	</style>
</header>
<body>
	<br />
	<br />
	<br />
	<?php
		if (mysqli_num_rows($pubs)>=1) {
			echo "<h3>Os teus pedidos de amizade:</h3>";
			while ($pub=mysqli_fetch_assoc($pubs)) {
				$email = $pub['de'];
				$saberr = mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
				$saber = mysqli_fetch_assoc($saberr);
				$nome = $saber['nome']." ".$saber['apelido'];
				$id = $pub['id'];

				echo '<div class="pub" id="'.$id.'">
					<span>'.$nome.' quer ser teu amigo/a</span><br />
					<p><a href="profile.php?id='.$saber['id'].'">Ver perfil de '.$nome.'</a></p><br />
					<a href="notificacoes.php?id='.$saber['id'].'"><input type="submit" value="Sim, aceito" name="add"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="notificacoes.php?remove='.$saber['id'].'"><input type="submit" value="Não, obrigado" name="remove"></a>
					<br /><br />
				</div>';
			}
			echo "<br /><h3>Não tens mais pedidos de amizade...</h3><br /><br />";
		}
	?>
	<br />
	<?php
		if (mysqli_num_rows($notificacoes)>=1) {
			echo "<h3>As tuas notificações:</h3>";
			while ($not=mysqli_fetch_assoc($notificacoes)) {
				$email = $not['userde'];
				$saberr = mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
				$saber = mysqli_fetch_assoc($saberr);
				$nome = $saber['nome']." ".$saber['apelido'];
				$id = $not['id'];

				if ($not['tipo']=="1") {
					echo '<br /><div class="not" id="'.$id.'">
						<a href="myprofile.php?id='.$not['post'].'">'.$nome.' gostou da tua publicação</a>
					</div>';
				}elseif($not['tipo']=="2"){
					echo '<br /><div class="not" id="'.$id.'">
						<a href="comentarios.php?id='.$not['post'].'">'.$nome.' comentou a tua publicação</a>
					</div>';
				}
			}
			echo "<br /><h3>Não tens mais notificações...</h3>";
		}else{
			echo "<br /><h3>Não tens notificações...</h3>";
		}
	?>
	<br />
	<div id="footer"><p>&copy; ICY, 2019 - Todos os direitos reservados</p></div><br />
</body>
</html>