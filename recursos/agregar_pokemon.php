<?php
require_once("header.php");
$lista_tipos=obtenerTiposPokemon($conn);

if(isset($_POST["submit"])) {

    $nombre_nuevo=$_POST["nombre_poke"];
    $dir_subida = "pokemones/";
    $fichero_subido = $dir_subida . basename($_FILES['fileToUpload']['name']);
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fichero_subido);
    rename($dir_subida.$_FILES["fileToUpload"]["name"], $dir_subida.$nombre_nuevo.'.png');

$resultado=guardarNuevoPokemon($conn,
    $_POST["numero_poke"],
    $nombre_nuevo,
    $_POST["desc_poke"],
    $_POST["tipo_poke"],
    $nombre_nuevo.".png");
?>
<div class="w3-panel w3-green">
    <h3><?php echo $resultado;?></h3>
</div>
<?php
}
?>
<h3>Agregar Nuevo Pokemon</h3>
<br>
<br>
<div class="w3-container w3-left">
    <form name="form_load" action="#" method="post" enctype="multipart/form-data">
        <label>Ingresa Numero:</label>
        <br>
        <input type="number" name="numero_poke" id="numero_poke" required>
        <br>
        <label>Ingresa Nombre:</label>
        <br>
        <input type="text" name="nombre_poke" id="nombre_poke" required>
        <br>
        <br>
        <label>Selecciona Tipo:</label>
        <br>
        <?php echo $lista_tipos;?>
        <br>
        <label>Ingresa Descripcion:</label>
        <br>
        <textarea name="desc_poke" id="desc_poke" required></textarea>
        <br>
        <label for="archivo">Foto:</label>
        <input type="file" id="fileToUpload" name="fileToUpload">
        <br>
        <br>
        <button class="w3-button w3-blue-gray" type="submit" value="Upload Image" name="submit">Enviar</button>
    </form>
</div>
<?php
cerrar_conexion($conn);
require_once("footer.php");