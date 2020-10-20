<?php
session_start();
include_once("rutas.php");

if(isset($_POST["cerrar"])){
    session_destroy();
}

$usuario=isset($_POST['username'])?$_POST['username']:null;
$clave=isset($_POST['password'])?$_POST['password']:null;
$limpiar=isset($_POST['limpiar'])?$_POST['limpiar']:null;
$criterio=isset($_POST['criterio'])?$_POST['criterio']:null;


include_once ("funciones.php");
include_once ("conexion.php");

$conn = establecer_conexion($usuario, $clave);
if ($conn != null) {
    $nombreUsuario =isset($_SESSION["poke_user"])?$_SESSION["poke_user"]: obtenerUsuarioSession($conn, $usuario, $clave);
    $_SESSION["poke_user"]=$nombreUsuario;
}
$administrador=isset($_SESSION["poke_user"])?$_SESSION["poke_user"]:null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>pokedex</title>
    <meta content='charset=UTF-8;'>
    <meta X-Content-Type-Options="nosniff">
    <link rel="stylesheet" type="text/css" href="<?php echo RECURSOS_PATH.'style.css';?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo RECURSOS_PATH.'w3.css';?>" media="screen" >
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
    <div class="header">
        <div class="w3-row">
            <div class="header-left w3-bar-item">
                <a href="<?=INDEX_PATH?>">
                    <img style="width:15%;max-width:15%;" src="<?php echo RECURSOS_PATH.'poke-icon.png';?>" alt="logo-poke">
                </a>
            </div>
            <?php
            if($administrador!=null){
                ?>
                <div class="header-right">
                    <div class="w3-dropdown-hover">
                        <button class="w3-button">
                            <i class="fa fa-user"></i>
                            Bienvenido: <?php echo $administrador;?>
                        </button>
                        <div class="w3-dropdown-content w3-bar-block w3-card-4">
                            <a class="w3-bar-item w3-button" href="<?php echo RECURSOS_PATH.'logout.php';?>"><i class="fa fa-sign-in"></i> Salir</a>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="header-right">
                    <form method="post" action="<?php echo INDEX_PATH;?>">
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
<br>
<body>
<h1 class="w3-center">Pokedex</h1>
<br>
