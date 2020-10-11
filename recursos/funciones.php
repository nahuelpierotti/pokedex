<?php

function obtenerUsuarioSession($conexion,$usuario,$clave){
        $clave = md5($clave);
        $nombre_usuario=null;
        $sql_existe = " select nombre from pkx_usuario where usuario='" . $usuario . "' and clave='" . $clave . "'";
        if ($result = mysqli_query($conexion, $sql_existe)) {
            session_start();
            $array_resultado = $result->fetch_assoc();
            $_SESSION["poke_user"] = $array_resultado["nombre"];
            $nombre_usuario= $array_resultado["nombre"];
        }
        return $nombre_usuario;
}
function obtenerImagenes(){
    $folder_path = 'recursos/pokemones/';

    $num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);

    $folder = opendir($folder_path);


    if($num_files > 0)
    {
        while(false !== ($file = readdir($folder)))
        {
            $file_path = $folder_path.$file;
            $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
            if($extension =='png')
            {
                ?>
                <a href="<?php echo $file_path; ?>">
                    <img src="<?php echo $file_path; ?>"  height="250" />
                </a>
                <?php
            }
        }
    }
}
function buscar_pokemon($conexion,$criterio,$limpiar){
    $folder_path = 'recursos/pokemones/';
    $folder = opendir($folder_path);

?>
    <table class="w3-table w3-bordered w3-responsive">
        <tr>
            <th>IMAGEN</th>
            <th>TIPO</td>
            <th>NRO</th>
            <th>NOMBRE</td>
        </tr>
<?php
        $sql="select p.imagen,p.numero,t.descripcion as tipo,p.nombre "
                ." from pkx_pokemones p "
                ." join pkx_tipos_pokemones t "
                ." on p.tipo=t.id_tipo";
        if($criterio!=null || $limpiar==null) {
            $sql=$sql." WHERE p.nombre like '%$criterio%' or t.descripcion like '%$criterio%' or p.numero like '%$criterio%'";
        }
        //echo  $sql;
        if ($result = mysqli_query($conexion, $sql)) {
            while ($registro = $result->fetch_assoc()){
            $file_path = $folder_path.$registro['imagen'];
?>
            <tr>
                <td>
                    <a href="<?php echo $file_path; ?>">
                        <img src="<?php echo $file_path; ?>" width="50px" height="60px" />
                    </a>
                </td>
                <td><?php echo $registro['tipo'];?></td>
                <td><?php echo $registro['numero'];?></td>
                <td><?php echo $registro['nombre'];?></td>
            </tr>
            <?php
            }
        }
        ?>
    </table>
    <?php
}
?>