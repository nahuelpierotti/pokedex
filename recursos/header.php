<?php
$usuario=isset($_POST['username'])?$_POST['username']:null;
$clave=isset($_POST['password'])?$_POST['password']:null;
$limpiar=isset($_POST['limpiar'])?$_POST['limpiar']:null;
$criterio=isset($_POST['criterio'])?$_POST['criterio']:null;

require_once ("conexion.php");
require_once ("funciones.php");

$conn = establecer_conexion($usuario, $clave);
if ($conn != null) {
    $nombreUsuario = obtenerUsuarioSession($conn, $usuario, $clave);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>pokedex</title>
    <meta content='charset=UTF-8;'>
    <meta X-Content-Type-Options="nosniff">
    <link rel="stylesheet" type="text/css" href="recursos/w3.css" media="screen" >
    <link rel="stylesheet" type="text/css" href="recursos/style.css" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
    <div class="header">
        <div class="w3-row">
            <div class="header-left w3-bar-item">
                <a href="#">
                    <img style="width:15%;max-width:15%;" src="recursos/poke-icon.png" alt="logo-poke">
                </a>
            </div>
            <?php
            if(isset($_SESSION["poke_user"])){
                ?>
                <div class="header-right">
                    <p><i class="fa fa-user"></i> Bienvenido: <?php echo $_SESSION["poke_user"];?></p>
                </div>
                <?php
            }else{
                ?>
                <div class="header-right">
                    <form method="post" action="index.php">
                        <input class="w3-bar-item" type="text" name="username" placeholder="Usuario" required>
                        <input class="w3-bar-item" type="password" name="password" placeholder="Clave" required>
                        <input class="w3-bar-item w3-btn w3-light-blue" type="submit" value="Ingresar">
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</header>
