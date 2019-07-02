<?php
include("header.php ");
//include("db.php");
$pubs=mysqli_query($connect,"SELECT * FROM publicacao ORDER BY id desc");

if (isset($_POST['publish'])) {
	if ($_FILES["file"]["error"]>0) {
		$texto=$_POST['texto'];
		$data=date("Y/m/d");

		if ($texto=="") {
			echo "<h3> Tens de escrever algo antes de publicar</h3>";
		} else{
			$query= "INSERT INTO publicacao(utilizador,texto,data) VALUES ('$login_cookie','$texto','$data')";
			$result=mysqli_query($connect,$query) or die ("houve um problema ao inserir os dados");
			if ($result) {
				header("location: ./");
			} else {
				echo "<h3> Alguma coisa deu errado!, tente novamente mais tarde</h3>";
			}

		}
	} else{
		$n=rand(0,1000000);
		$img=$n.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);

		$texto= $_POST['texto'];
		$data= date("Y/m/d");

		if ($texto=="") {
			echo "<h3> Tens de escrever algo antes de publicar</h3>";

			# code...
		} else{
			$query= "INSERT INTO publicacao(utilizador, texto,imagem,data) VALUES ('$login_cookie','$texto','$img','$data')";
			$result=mysqli_query($connect,$query) or die ("houve um problema ao inserir os dados");
			if ($result) {
				header("location: ./");
			} else {
				echo "<h3> Alguma coisa deu errado!, tente novamente mais tarde</h3>";
			}
		} 
	}
}
//echo "Se estas a ver essa pagina, e porque conseguiste iniciar a sessao";
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		div#publish{
			width: 400px;
			height: 210px;
			display: block;
			margin: auto;
			border: none;
			border-radius: 5px;
			background: #FFF;
			box-shadow: 0 0 6px #A1A1A1; 
			margin-top:30px; 
		}
		div#publish textarea{
			width: 365px;
			height: 100px;
			display: block;
			margin: auto;
			border-radius: 5px;
			padding-left: 5px;
			padding-top: 5px;
			border-width: 1px;
			border-color: #A1A1A1;
		}
		div#publish img{
			margin-top: 0px;
			margin-left: 10px;
			width: 40px;
			cursor: pointer;
		}
		div#publish input[type="submit"]{
			width: 70px;
			height: 25px;
			border-radius: 	3px;
			float: right;
			margin-right: 15px;
			border: none;
			margin-top: 5px;
			background: #4169E1;
			color: #FFF;
			cursor: pointer;
		}
		div#publish input[type="submit"]:hover{background: #001F3F;
		}

		div.pub{width: 400px;
			min-height: 70px;
			max-height: 1000px;
			display: block;
			margin: auto;
			border: none;
			border-radius: 5px;
			background-color: #FFF;
			box-shadow: 0 0 6px #A1A1A1;
			margin-top:  30px;
		}

		div.pub a{
			color: #666;
			text-decoration: none;
		}

		div.pub a:hover{
			color: #111;
			text-decoration: none;
		}

		div.pub p{
			margin-left: 10px;
			content: #666;
			padding-top: 10px;
		}

		div.pub span{
			display: block;
			margin:auto;
			width: 380px;
			margin-top: 10px;
		}	

		div.pub img{
			display: block;
			margin: auto;
			width: 100%;
			margin-top: 10px;
			border-bottom-left-radius: 5PX;
			border-bottom-right-radius: 5px;
		}
	</style>
</head>
<body>
	<div id="publish">
		<form  method="POST" enctype="multipart/form-data">
			<br />			
			<textarea placeholder="escreva uma nova publicacao" name="texto"></textarea>
			<label for="file-input">
				<img src="img/photos.png" title="inserir fotografia"/>
			</label>
			<input type="submit" value="Publicar" name="publish"/>
			<input type="file" id="file-input" name="file" hidden />
		</form>
	</div>
	<?php
	while ($pub=mysqli_fetch_assoc($pubs)) {
		$email=$pub['utilizador'];
		$saberr=mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
		$saber=mysqli_fetch_assoc($saberr);
		$nome=$saber['nome']."".$saber['apelido'];
		$id=$pub['id'];

		if ($pub['imagem']=="") {
			echo '<div class="pub" id="'.$id.'">
			<p><a href= "#">'.$nome.'</a> -'.$pub["data"].'</p>
			<span>'.$pub['texto'].'</span><br />
			</div>';
		} else{
			echo '<div class= "pub" id="'.$id.'">
			<p><a href= "#">'.$nome.'</a> - '.$pub["data"].'</p>
			<span>'.$pub['texto'].'</span>
			<img src="upload/'.$pub["imagem"].'"/>
			</div>';

		}
	}
	?>
</body>
</html>