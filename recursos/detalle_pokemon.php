<?php
$ruta="";
include_once ("header.php");

$numero_pokemon=isset($_GET['n'])? $_GET['n']:null;

obtenerPokemon($conn,$numero_pokemon);


require_once ("footer.php");
