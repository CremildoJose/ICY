<?php
	include("header.php");

	$id = $_GET["from"];

	$tudo = mysql_query("SELECT * FROM users WHERE id='$id'");
	$saber = mysql_fetch_assoc($tudo);

	$email = $saber["email"];

	$sql = mysql_query("SELECT * FROM mensagens WHERE para='$login_cookie' AND de='$email' OR de='$login_cookie' AND para='$email' ORDER BY id");

	if (isset($_POST["send"])) {
		$msg = $_POST['text'];
		$data = date("Y/m/d");

		if ($msg=="") {
			echo "<h3>Não podes enviar uma mensagem em branco!</h3>";
		}else{
			$query = "INSERT INTO mensagens (`de`,`para`,`texto`,`status`,`data`) VALUES ('$login_cookie','$email','".mysql_real_escape_string($msg)."',0,'$data')";
			$data = mysql_query($query);
			if ($data) {
				header("refresh:0;");
			}else{
				echo "<h3>Algo não correu muito bem ao enviar a tua mensagem... Desculpa</h3>".mysql_error();
			}
		}
	}
?>
<html>
	<head>
		<style type="text/css">
		h2{text-align: center; font-size: 32px; color: #007fff;}
		h3{text-align: center; font-size: 25px; color: #666;}
		a{color: #007fff; text-decoration: none;}
		div#box{display: block; margin: auto; width: 650px; height: 400px;}
		div#send{width: 100%; position: fixed; bottom: 0; text-align: center;}
		div#send input[name="image"]{width: 100px; height: 35px; border: none; border-radius: 3px; font-size: 16px; background: #007fff; color: #FFF; cursor: pointer; display: inline-block; margin-bottom: 10px;}
		div#send input[name="text"]{width: 35%; height: 35px; border: none; border-radius: 3px; font-size: 16px; padding-left: 10px; display: inline-block; margin-bottom: 10px;}
		div#send input[name="send"]{width: 100px; height: 35px; border: none; border-radius: 3px; font-size: 16px; background: #007fff; color: #FFF; cursor: pointer; display: inline-block; margin-bottom: 10px;}
		</style>
	</head>
	<body>
		<br />
		<h2><a href="profile.php?id=<?php echo $id; ?>"><?php echo $saber["nome"]; ?></a></h2><br /><br /><br />
		<form method="POST">
			<div id="box">
				<object type="text/html" data="bubble.php?from=<?php echo $id; ?>#bottom" width="635px" height="390px" style="overflow: auto; display: block; margin: auto;"></object>
			</div>
			<br />
			<div id="send">
				<a href="image.php?id=<?php echo $id; ?>"><input value="Imagem" type="button" name="image"></a>&nbsp;&nbsp;&nbsp;<input type="text" name="text" placeholder="Mensagem..." autocomplete="off">&nbsp;&nbsp;&nbsp;<input type="submit" name="send" value="Enviar">
			</div>
		</form>
	</body>
</html>