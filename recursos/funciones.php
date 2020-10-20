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
    $sql="select p.imagen,p.nombre,p.descripcion,p.tipo "
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
    $sql="select p.imagen,p.nombre,p.descripcion,p.numero,p.tipo "
        ." from pkx_pokemones p "
        ." WHERE p.numero=".$numero_pokemon."";

    if ($result = mysqli_query($conexion, $sql)) {
        while ($registro = $result->fetch_assoc()) {
            $file_path = $folder_path . $registro['imagen'];
            ?>
            <?php if($_SESSION["poke_user"]!=null){
            ?>
            <div class="w3-container">
                <form  action="editar_pokemon.php" method="post" >
                    <input type="hidden" name="numero_anterior" id="numero_anterior" value="<?php echo $numero_pokemon;?>">
                    <input type="hidden" name="nombre_anterior" id="nombre_anterior" value="<?php echo $registro['nombre'];?>">
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
                        <textarea name="descri_poke" rows="4" cols="50" >
                            <?php echo $registro['descripcion'];?>
                        </textarea>
                        <br>
                        <label>Edita el Tipo:</label>
                        <br>
                        <?php echo obtenerTiposPokemon($conexion);?>
                        <br>
                    </div>
                    <br>
                    <br>
                    <br>
                    <button class="w3-row w3-button w3-blue-gray" type="submit" value="Upload Image" name="submit">Enviar</button>
                </form>
            </div>
<?php
            }
        }
    }
}

function buscar_pokemon($conexion,$criterio,$limpiar){
    $folder_path = "recursos/pokemones/";
    $folder_tipos_path="recursos/tipos/";

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
            $hay_algo=0;
            while ($registro = $result->fetch_assoc()){
            $hay_algo++;
            $file_path = $folder_path.$registro['imagen'];
            $file_tipo=$folder_tipos_path.$registro['tipo'].'.png';
?>
            <tr>
                <td>
                    <a href="recursos/detalle_pokemon.php?n=<?php echo $registro['numero'];?>">
                        <img src="<?php echo $file_path; ?>" width="50px" height="60px" />
                    </a>
                </td>
                <td><img src="<?php echo $file_tipo; ?>" width="60px" height="20px">
                </td>
                <td><?php echo $registro['numero'];?></td>
                <td><?php echo $registro['nombre'];?></td>
                <?php if($_SESSION["poke_user"]!=null){
                    ?>
                <td>
                    <a href="recursos/editar_pokemon.php?n=<?php echo $registro['numero'];?>" class="w3-btn w3-orange w3-left">Editar</a>
                    <a href="recursos/borrar_pokemon.php?n=<?php echo $registro['numero'];?>&im=<?php echo $registro['imagen'];?>"class="w3-btn w3-red w3-right">Borrar</a>
                </td>
                    <?php
                }
                ?>
            </tr>
            <?php
            }
        }
        if($hay_algo==0){
        ?>
        <br>
        <div class="w3-panel w3-light-blue">
            <h3>No se encontraron pokemones con ese criterio de busqueda.</h3>
        </div>
        <br>
        <?php
            $sql="select p.imagen,p.numero,t.descripcion as tipo,p.nombre "
                ." from pkx_pokemones p "
                ." join pkx_tipos_pokemones t "
                ." on p.tipo=t.id_tipo";
            if ($result = mysqli_query($conexion, $sql)) {
                while ($registro = $result->fetch_assoc()){
                    $file_path = $folder_path.$registro['imagen'];
                    $file_tipo=$folder_tipos_path.$registro['tipo'].'.png';
                    ?>
                    <tr>
                        <td>
                            <a href="recursos/detalle_pokemon.php?n=<?php echo $registro['numero'];?>">
                                <img src="<?php echo $file_path; ?>" width="50px" height="60px" />
                            </a>
                        </td>
                        <td><img src="<?php echo $file_tipo; ?>" width="60px" height="20px">
                        </td>
                        <td><?php echo $registro['numero'];?></td>
                        <td><?php echo $registro['nombre'];?></td>
                        <?php if($_SESSION["poke_user"]!=null){
                            ?>
                            <td>
                                <a href="recursos/editar_pokemon.php?n=<?php echo $registro['numero'];?>" class="w3-btn w3-orange w3-left">Editar</a>
                                <a href="recursos/borrar_pokemon.php?n=<?php echo $registro['numero'];?>&im=<?php echo $registro['imagen'];?>"class="w3-btn w3-red w3-right">Borrar</a>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
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

function borrarPokemon($conexion, $numero,$imagen){
    $filename = 'pokemones/'.$imagen;
    if (file_exists($filename)) {
        $success = unlink($filename);
        if (!$success) {
             throw new Exception("Cannot delete $filename");
        }else{

            $sql = "DELETE FROM pkx_pokemones WHERE numero=".$numero;
            if (mysqli_query($conexion, $sql)) {
                return "Se elimino correctamente el pokemon de la base de datos.";
            } else {
                return "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }
        }
    }
}

function editarPokemon($conexion, $numero,$nro_nuevo,$nombre,$nombre_nuevo,$descripcion,$tipo){

    $dir_subida = "pokemones/";
    rename($dir_subida.$nombre.'.png', $dir_subida.$nombre_nuevo.'.png');

    $sql = "UPDATE pkx_pokemones SET numero=".$nro_nuevo.",nombre='".$nombre_nuevo."',";
    $sql.=" descripcion='".$descripcion."',tipo=".$tipo.", imagen='".$nombre_nuevo.".png'";
    $sql.=" WHERE numero=".$numero."";

    echo 'Consulta SQL_UPDATE: '.$sql;

    if (mysqli_query($conexion, $sql)) {
        return "Los cambios se guardaron correctamente.";
    } else {
        return "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

?>