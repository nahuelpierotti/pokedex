<?php

function establecer_conexion($usuario,$clave){

        $servername = "localhost";
        $database = "pokedex-pierotti-nahuel";
        $username = "user";
        $password = "password";
        $conn = new mysqli($servername, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            return null;
        } else {
            return $conn;
        }

}

function cerrar_conexion($conexion){
    if($conexion!=null) {
        mysqli_close($conexion);
    }
}