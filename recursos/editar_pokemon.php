<?php
include_once("header.php");

$numero_pokemon = isset($_GET['n']) ? $_GET['n'] : null;
if($numero_pokemon!=null) {
    obtenerPokemonEditable($conn, $numero_pokemon);
}else {
        $numero_anterior = isset($_POST["numero_anterior"]) ? $_POST["numero_anterior"] : null;
        $numero_nuevo = isset($_POST["numero_poke"]) ? $_POST["numero_poke"] : null;
        $nombre_nuevo = isset($_POST["nombre_poke"]) ? $_POST["nombre_poke"]: null;
        $nombre_anterior = isset($_POST["nombre_anterior"]) ? $_POST["nombre_anterior"] : null;
        $descri_poke = isset($_POST["descri_poke"]) ? $_POST["descri_poke"] : null;
        $tipo_poke = isset($_POST["tipo_poke"]) ? $_POST["tipo_poke"] : null;

        $resultado = editarPokemon($conn, $numero_anterior, $numero_nuevo, $nombre_anterior, $nombre_nuevo, $descri_poke, $tipo_poke);


}


