	<?php
		include("db.php");
		
		$login_cookie=$_COOKIE['login'];
		if (!isset($login_cookie)) {
			header("location: login.php");
			# code...
		}
	?>

	<! DOCTYPE html>
	<html>
	<head>
		<style type="text/css">
			*{font-family: 'Montserrat',cursive;
margin: 0;}	
	div#topo{
		width: 100%;
		top: 0;
		background: #FFF;
		box-shadow: 0 0 10px #000;
		height: 80px;
	}

	div#topo img[name="logo"]{
		float: left;
		margin-left: 20px;
		margin-top: 10px;
	}

	div#topo img[name="menu"]{
		float: right;
		margin-right: 25px;
		margin-top: -22px;
		padding-right: 100px; 
	}

	div#topo input[type="text"]{
		display: block;
		margin:auto;
		width: 300px;
		border: none;
		border-radius: 3px;
		background: #F6F6F6;
		height: 25px;
		padding-left: 10px;
		box-shadow: inset 0 0 6px #000;
	}

	div#topo form{
		width: 300px;
		display: block;
		margin: auto;
		padding-top: 22px;
	}
		</style>
	
		
		
	</head>
	<body>
		<div id="topo">
			<img src="img/icylogo1.jpg" width="25" name="logo">
			<form method="GET">
			<input type="text" placeholder="pesquisar..." name="query" autocomplete="off" ><input type="submit" hidden>
			</form>
			<img src="img/users/topbar.jpg" width="20">
			<img src="img/users/chat.png" width="100">
		</div>
	</body>
	</html>