<?php
	include("../db.php");

	$login_cookie = $_COOKIE['login'];
	if (!isset($login_cookie)) {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<style type="text/css">
	*{font-family: 'Montserrat', cursive; margin: 0;}
	body{background: #F6F6F6;}
	div#topo{width: 100%; top: 0; background: #FFF; box-shadow: 0 0 10px #000; height: 80px; text-align: center; z-index: 999;}
	div#topo img[name="menu"]{display: inline-block; margin-top: 20px;}
	div#footer{bottom: 0; display: block; margin: auto; width: 90%; margin-top: 20px; text-align: center; color: #666;}
	</style>
</head>
<body>
	<div id="topo">
		<a href="index.php"><img src="../img/home.png" width="30" name="menu"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="inbox.php"><img src="../img/chat.png" width="30" name="menu"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="notificacoes.php"><img src="../img/notificacoes.png" width="35" name="menu"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="pesquisar.php"><img src="../img/pesquisar.png" width="30" name="menu"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="myprofile.php"><img src="../img/perfil.png" width="30" name="menu"></a>
	</div>
</body>
</html>