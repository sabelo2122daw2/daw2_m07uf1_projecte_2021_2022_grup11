<?php
    session_start();
	echo "Nombre de usuario: " . $_SESSION["usuario"];
	
	$fitxer_usuaris="/var/www/html/Projecte/PHP/usuaris";
	$fp=fopen($fitxer_usuaris,"r+") or die ("No s'ha pogut validar l'usuari");
	if ($fp) {
		$mida_fitxer=filesize($fitxer_usuaris);	
		$usuari = explode(PHP_EOL, fread($fp,$mida_fitxer));
	}

	foreach ($usuari as $user) {
		$logpwd = explode(":",$user);
		if (($_POST['proid'] == $logpwd[0])){
			if ("proid" != NULL){
			$a = $user;
			$b = file_get_contents('usuaris');;
			$c = preg_replace("/$a/", '', $b); 
			file_put_contents($fitxer_usuaris, $c);
		}
	}
	}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <FONT FACE="">
        <link href="../CSS/estilsinterficieadmin.css" rel="stylesheet" type="text/css">
        <TITLE>Projecte M07 - UF1</TITLE>
</head>
	<body>
		<div class="back"></div>
		<nav>
			<a href="interficieadmin.php" class="menu">Pagina Principal</a>
            <a href="llibresadmin.php" class="menu">Llibres</a>
		    <a href="usuarisadmin.php" class="menu">Usuaris</a>
		</nav>
        <div class="titolp">
			<h1 id="black">BORRAR USUARIS</h1>
        </div>
        <div class="indexdivproductes">
            <form action="" method="POST">
            <br><p id="white" class="pinicisessio">NOM DE L'USUARI A ESBORRAR</p>
                <input type="text" name="proid" placeholder=""><br><br>
                <input type="submit" class="comanda" value="BORRAR"><br><br><br>
            </form>
        </div>
        <div class="usuaricuadre">
			<form action="http://localhost/Projecte/PHP/logoutadmin.php" method="POST">
				<p class="pinicisessio1"><?php
				if (!isset($_SESSION["comptador"])) {
					$_SESSION['comptador'] = 1;
					echo "Benvingut " . $_SESSION["usuario"]."<br>";
					echo "Visites web: " . $_SESSION["comptador"] . " durant aquesta sessió.<br>";
					echo "Aquest és el primer accés.<br>";			 
				}	
				else{
					$_SESSION["comptador"] += 1;
					echo "Benvingut " . $_SESSION["usuario"]."<br>";
					echo "Visites web: " . $_SESSION["comptador"] . " durant aquesta sessió.<br>";
					echo "Ultima visita: " . $_SESSION["data_darrer_acces"] . ".<br>";
				}
				date_default_timezone_set('Europe/Andorra');
				$_SESSION['data_darrer_acces'] = date('d/m/Y h:i:s');
			?></p>
				<input id="noV" type="user" name="usuari" value="<?php echo "".session_name()."";?>">
				<input id="noV" type="password" name="ctsnya" value="<?php echo "".$password."";?>">
				<input type="submit" value="LOG OUT">
			</form>
        </div>
    </body>
</html>