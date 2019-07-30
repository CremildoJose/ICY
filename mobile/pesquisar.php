<?php
	include("header.php");
?>
<html>
	<header>
		<style type="text/css">
			h3{text-align: center; font-size: 32px; color: #666;}
			h2{text-align: center; font-size: 46px; color: #666;}
			p[name="p"]{display: block; margin: auto; font-size: 20px; text-align: center; color: #FFF; max-width: 700px;}
			a[name="p"]{color: #111111; text-decoration: none;}
			hr{border: 1px solid #666; width: 500px; display: block; margin: auto;}
			input[type="text"]{display: block; margin: auto; width: 250px; border: none; border-radius: 3px; background: #F6F6F6; height: 40px; padding-left: 10px; font-size: 22px; box-shadow: inset 0 0 6px #666;}
		</style>
	</header>
	<body>
		<br />
		<h2>Pesquisar</h2><br />
		<?php
			if (isset($_GET['query'])){
				$query = $_GET['query'];

				$min_length = 3;

				if (strlen($query) >= $min_length) {
					$query = htmlspecialchars($query);

					$query = mysql_real_escape_string($query);

					$raw_results = mysql_query("SELECT * FROM users WHERE (`nome` LIKE '%".$query."%')") or die(mysql_error());

					if (mysql_num_rows($raw_results) > 0) {
						echo "<br /><br />";
						while ($results = mysql_fetch_array($raw_results)) {
							echo '<a href="profile.php?id='.$results["id"].'" name="p"><br /><p name="p"><h3>'.$results["nome"].' '.$results["apelido"].'</h3></p><br /></a><br /><hr /><br />';
						}
					}else{
						echo "<br /><h3>Não foram encontrados resultados...</h3>";
					}
				}else{
					echo "<br /><h3>Tens de escrever pelo menos 3 letras...</h3>";
				}
			}else{
				echo '<br /><br /><br />
					<form method="GET" action="pesquisar.php">
						<input type="text" placeholder="Pesquisa alguém..." name="query" autocomplete="off"><input type="submit" hidden>
					</form>';
			}
		?>
	</body>
</html>