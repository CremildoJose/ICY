<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$connect = mysqli_connect("127.0.0.1","root","") or die("Não foi possível ligar ao servidor...");
	$db = mysqli_select_db($connect,"aula-rede-social1") or die("Impossível entrar na Base de dados");
?>
<html>
<header>
	<meta charset="utf-8">
	<title>Meet new Friends!</title>
	<style type="text/css">
		html{
			-webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
		       -moz-animation: fadein 2s; /* Firefox < 16 */
		        -ms-animation: fadein 2s; /* Internet Explorer */
		         -o-animation: fadein 2s; /* Opera < 12.1 */
		            animation: fadein 2s;
		}

		@keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Firefox < 16 */
		@-moz-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Safari, Chrome and Opera > 12.1 */
		@-webkit-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Internet Explorer */
		@-ms-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Opera < 12.1 */
		@-o-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}}
	</style>
</header>
</html>