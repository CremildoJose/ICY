<?php
	//include("header.php");
	//require_once('db.php');

?>

<html>
<header>
	<style type="text/css">
		#img{
	width: 80%;
	height: 380px;
	margin-left: 45px;

}

#img_left, #img_right{
	width: 85px;
	border: solid 1px;
	border-color:  #e8e8e8;
	margin-right: 13px;
	background-color: #f2f2f2;
	padding-left: 7px;
	padding-right: 7px;
	padding-bottom: 30px;
	padding-top: 30px;
}

 #img_bmw2,#img_toyota2,#img_ford{
	margin-top: 25px;
}

	div#publish{width: 400px; height: 210px; display: block; margin: auto; border: none; border-radius: 5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div.leftElement{width: 100px; float: left; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1; box-shadow: 0 0 5px  #A1A1A1;}
	div.rightElement{width: 100px; float: right; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1; box-shadow: 0 0 5px  #A1A1A1;}
	div#publish img{margin-top: 0px; margin-left: 10px; width: 40px; cursor: pointer;}
	div#publish input[type="submit"]{width: 70px; height: 25px; border-radius: 3px; float: right; margin-right: 15px; border: none; margin-top: 5px; background: #4169E1; color: #FFF; cursor: pointer;}
	div#publish input[type="submit"]:hover{background: #001F3F;}

	div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
	div.pub a{color: #666; text-decoration: none;}
	div.pub a:hover{color: #111; text-decoration: none;}
	div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
	div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
	div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}

	div#love{width: 400px; height: 30px; display: block; margin: auto; border: none; border-radius: 5px; background: #007fff; margin-top: 5px;}
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
		<div class="leftElement">
			<input type=image src="img\bmw.png" id="img_left" onclick="" >
		</div>
		<div class="rightElement">
			<input type=image src="img\huynday.png" id="img_right">
		</div>
		<form method="POST" enctype="multipart/form-data">
			<br />
			<!--<textarea placeholder="Escreve uma publicacão nova" name="texto"></textarea>--> 
			<label for="file-input">
				<img src="img/imagegrey.png" title="Inserir uma fotografia" />
			</label>
			<input type="submit" value="Publicar" name="publish" />

			<input type="file" id="file-input" name="file" hidden />
		</form>
	</div>
	<div id="footer"><p>&copy; ICY, 2019 - Todos os direitos reservados</p></div><br />
</body>
</html>

<!-- 
	<div class="publish">
		<div class="leftElement">

		</div>
		<div class="vs">
			<label>VS</label>
		</div>
		<div class="rightElement">

		</div>
	</div>


css


.publish{
	display:flex;
	justify-content:space-between;
}
.leftElement{
	border-radius:5px;
}
-->