<?php

function obtenerUsuarioSession($conexion,$usuario,$clave){
        $clave = md5($clave);
        $nombre_usuario=null;
        $sql_existe = " select nombre from pkx_usuario where usuario='" . $usuario . "' and clave='" . $clave . "'";
        if ($result = mysqli_query($conexion, $sql_existe)) {
            $array_resultado = $result->fetch_assoc();
            $nombre_usuario= $array_resultado["nombre"];
        }
        return $nombre_usuario;
}
function obtenerPokemon($conexion,$numero_pokemon){
    $folder_path = 'pokemones/';
    $sql="select p.imagen,p.nombre,p.descripcion "
        ." from pkx_pokemones p "
        ." WHERE p.numero=".$numero_pokemon."";

    if ($result = mysqli_query($conexion, $sql)) {
        while ($registro = $result->fetch_assoc()) {
            $file_path = $folder_path . $registro['imagen'];
            ?>
                <div class="w3-container">
                    <h3><?php echo $registro['nombre'];?></h3>
                    <br><br>
                    <div class="w3-row">
                        <div class="w3-left">
                            <img src="<?php echo $file_path; ?>" width="180px" height="150px" />
                        </div>
                        </div>
                        <div class="w3-row">
                        <br>
                        <div class="w3-left">
                            <div class="descripcion">
                                <?php echo $registro['descripcion'];?>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
<?php
        }
    }
}

function obtenerPokemonEditable($conexion,$numero_pokemon){
    $folder_path = 'pokemones/';
    $sql="select p.imagen,p.nombre,p.descripcion,p.numero "
        ." from pkx_pokemones p "
        ." WHERE p.numero=".$numero_pokemon."";

    if ($result = mysqli_query($conexion, $sql)) {
        while ($registro = $result->fetch_assoc()) {
            $file_path = $folder_path . $registro['imagen'];
            ?>
            <?php if($_SESSION["poke_user"]!=null){
            ?>
            <div class="w3-container">
            <label>Edita el Nombre:</label>
                <h3><input type="text" name="nombre_poke" value="<?php echo $registro['nombre'];?>"></h3>
                <br><br>
                <div class="w3-row w3-left">
                    <div class="w3-image">
                        <img src="<?php echo $file_path; ?>" width="180px" height="150px" />
                    </div>
                    <div class="w3-row w3-left">
                        <label>Edita el numero:</label>
                        <br>
                        <input value="<?php echo $registro['numero'];?>" name="numero_poke">
                        <br>
                        <label>Edita la descripcion: </label>
                        <br>
                        <textarea rows="4" cols="50" ><?php echo $registro['descripcion'];?></textarea>
                    </div>
                </div>
                        <?php
                    }else{
                    ?>
                    <div class="w3-container">
                    <h3><?php echo $registro['nombre'];?></h3>
                    <br><br>
                    <div class="w3-row">
                        <div class="w3-left">
                            <img src="<?php echo $file_path; ?>" width="100%" height="100%" />
                        </div>

                        <div class="w3-right">
                            <p><?php echo $registro['descripcion'];?></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
<?php
        }
    }
?>
<?php
}
function buscar_pokemon($conexion,$criterio,$limpiar){
    $folder_path = 'recursos/pokemones/';

?>
    <table class="w3-table w3-bordered w3-responsive">
        <tr>
            <th>IMAGEN</th>
            <th>TIPO</td>
            <th>NRO</th>
            <th>NOMBRE</td>
            <?php if($_SESSION["poke_user"]!=null){
            ?>
            <th>OPCIONES</th>
            <?php
            }
            ?>
        </tr>
<?php
        $sql="select p.imagen,p.numero,t.descripcion as tipo,p.nombre "
                ." from pkx_pokemones p "
                ." join pkx_tipos_pokemones t "
                ." on p.tipo=t.id_tipo";
        if($criterio!=null || $limpiar==null) {
            $sql=$sql." WHERE p.nombre like '%$criterio%' or t.descripcion like '%$criterio%' or p.numero like '%$criterio%'";
        }
        if ($result = mysqli_query($conexion, $sql)) {
            while ($registro = $result->fetch_assoc()){
            $file_path = $folder_path.$registro['imagen'];
?>
            <tr>
                <td>
                    <a href="recursos/detalle_pokemon.php?n=<?php echo $registro['numero'];?>">
                        <img src="<?php echo $file_path; ?>" width="50px" height="60px" />
                    </a>
                </td>
                <td><?php echo $registro['tipo'];?></td>
                <td><?php echo $registro['numero'];?></td>
                <td><?php echo $registro['nombre'];?></td>
                <?php if($_SESSION["poke_user"]!=null){
                    ?>
                <td>
                    <a href="recursos/editar_pokemon.php?n=<?php echo $registro['numero'];?>" class="w3-btn w3-orange w3-left">Editar</a>
                    <a href="#?borrar=<?php echo $registro['numero'];?>"class="w3-btn w3-red w3-right">Borrar</a>
                </td>
                    <?php
                }
                ?>
            </tr>
            <?php
            }
        }
        ?>
    </table>

    <?php
}

function obtenerTiposPokemon($conexion){
$sql="select id_tipo,descripcion from pkx_tipos_pokemones order by id_tipo;";
$lista="<select class='w3-select' name='tipo_poke' id='tipo_poke' >";

    if ($result = mysqli_query($conexion, $sql)) {
        while ($registro = $result->fetch_assoc()) {
            $lista.="<option value=".$registro['id_tipo']." >".$registro['descripcion']."</option>";
        }
    }
    $lista.="</select>";
    return $lista;

}

function guardarNuevoPokemon($conexion, $numero,$nombre,$descripcion,$tipo,$imagen){
$sql = "INSERT INTO pkx_pokemones (numero,nombre,descripcion,tipo,imagen) ";
    $sql.=" VALUES (".$numero.", '".$nombre."', '".$descripcion."','".$tipo."','".$imagen."')";
    if (mysqli_query($conexion, $sql)) {
        return "Se agrego el pokemon correctamente a la base de datos.";
    } else {
        return "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

function borrarPokemon($conexion, $numero){
$sql = "DELETE FROM pkx_pokemones WHERE numero=".$numero;
    if (mysqli_query($conexion, $sql)) {
        return "Se elimino correctamente el pokemon de la base de datos.";
    } else {
        return "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

function editarPokemon($conexion, $numero,$nro_nuevo,$nombre,$descripcion,$tipo){
$sql = "UPDATE pkx_pokemones SET numero=".$nro_nuevo.",nombre='".$nombre."',
        descripcion='".$descripcion."',tipo=".$tipo;
    $sql.=" WHERE numero=".$numero."";

    if (mysqli_query($conexion, $sql)) {
        return "Los cambios se guardaron correctamente.";
    } else {
        return "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

?>