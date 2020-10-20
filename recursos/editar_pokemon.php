<?php
require_once("header.php");

$numero_pokemon = isset($_GET['n']) ? $_GET['n'] : null;

obtenerPokemonEditable($conn, $numero_pokemon);


require_once("footer.php");