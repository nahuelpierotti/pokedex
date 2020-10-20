<?php
$ruta="";
include_once ("header.php");

$numero_pokemon=isset($_GET['n'])? $_GET['n']:null;

obtenerPokemon($conn,$numero_pokemon);


include_once ("footer.php");
