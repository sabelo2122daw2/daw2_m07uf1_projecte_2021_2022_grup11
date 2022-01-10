<?php
    session_start();
    echo "Nombre de usuario: " . $_SESSION["usuario"];
    if(($_POST['texto'])){
        $filename="/var/www/html/Projecte/PHP/prestec";
        $fitxer=fopen($filename,"a+") or die ("No s'ha pogut fer el registre del prestec");
        $textoprestec = ($_POST['texto']);
        $textoprestecescribir="$textoprestec\n";
        fwrite($fitxer,$textoprestecescribir);
        fclose($fitxer);
    }
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <FONT FACE="">
        <link href="../CSS/estilsinterficieuser.css" rel="stylesheet" type="text/css">
        <TITLE>Projecte M07 - UF1</TITLE>
</head>
	<body>
		<div class="back"></div>
		<nav>
			<a href="interficieuser.php" class="menu">Pagina Principal</a>
            <a href="prestecsuser.php" class="menu">Prestecs</a>
		</nav>
        <div class="indexdivproductes">
        <?php
               $fitxer_llibres="/var/www/html/Projecte/PHP/llibres";
               $fp=fopen($fitxer_llibres,"r+") or die ("No s'ha pogut validar l'usuari");
               if ($fp) {
                   $mida_fitxer=filesize($fitxer_llibres);	
                   $llibre = explode(PHP_EOL, fread($fp,$mida_fitxer));
               }
            ?>
            
            <div class="titolp">
			<h1 id="black">LLIBRES DISPONIBLES</h1>
        </div>
        <div class="indexdivproductes">
            <?php
               $fitxer_llibres="/var/www/html/Projecte/PHP/llibres";
               $fp=fopen($fitxer_llibres,"r+") or die ("No s'ha pogut validar l'usuari");
               if ($fp) {
                   $mida_fitxer=filesize($fitxer_llibres);	
                   $llibre = explode(PHP_EOL, fread($fp,$mida_fitxer));
               }
            ?>
            
            <?php 
                foreach ($llibre as $llibres){
                    $dadesllibre = explode(":",$llibres);
                    $llibreid = $dadesllibre[0];
                    $llibretitol = $dadesllibre[1];
                    $isbn = $dadesllibre[2];
                    $genere = $dadesllibre[3];
                    $texte="$llibreid:$llibretitol:$isbn:$genere\n";
                    echo '<br><p class="pinicisessio1">ID LLIBRE:</p><br><br><br><h6>'.$llibreid.'
                    </h6><p class="pinicisessio1">TITOL:</p><br><br><br><h6>'.$llibretitol.'
                    </h6><p class="pinicisessio1">ISBN:</p><br><br><br><h6>'.$isbn.'
                    </h6><p class="pinicisessio1">GENERE:</p><br><br><br><h6>'.$genere.'
                    </h6>';
                    echo '<p class="pinicisessio1">____________________________________________________________________________________________________________________';
                }
                ?>
        </div>
        </div>
        <div class="usuaricuadre">
			<form action="http://localhost/Projecte/PHP/logoutuser.php" method="POST">
				<p class="pinicisessio"><?php
				if (!isset($_SESSION["comptador"])) {
					$_SESSION['comptador'] = 1;
					echo "Benvingut " . $_SESSION['usuario']."<br>";
					echo "Visites web: " . $_SESSION["comptador"] . " durant aquesta sessió.<br>";
					echo "Aquest és el primer accés.<br>";			 
				}	
				else{
					$_SESSION["comptador"] += 1;
					echo "Benvingut " . $_SESSION['usuario']."<br>";
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
        <div class="usuaricuadreprestec">
            <p class="pinicisessio">LLIBRES DEMANATS:</p>
            <?php
                $fitxer_prestec="/var/www/html/Projecte/PHP/prestec";
                $fc=fopen($fitxer_prestec,"r") or die ("No s'han pogut llegir els prestecs");
                if ($fc) {
                    $mida_fitxerc=filesize($fitxer_prestec);	
                    $prestecs = explode(PHP_EOL, fread($fc,$mida_fitxerc));
                }
            ?>
            <?php 
                foreach ($prestecs as $productec) {
                    $dadesproductec = explode(":",$productec);
                    $producteidc = $dadesproductec[0];
                    $productenomc = $dadesproductec[1];
                    $productepreuc = $dadesproductec[2];
                    $productetipusc = $dadesproductec[3];
                    echo '<p id="llista" class="pinicisessio">'.$productenomc.' | '.$productepreuc.''; 
                }
                ?>
        </div>
    </body>
</html>