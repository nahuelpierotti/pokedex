<?php
$ruta="recursos/";

include_once ($ruta."rutas.php");
include_once ($ruta."header.php");
?>

<form class="example" method="post" action="#">
    <input type="text" placeholder="Ingrese nombre, tipo o numero de pokemon.." name="criterio" id="criterio">
    <button class="w3-btn w3-light-blue" type="submit"><i class="fa fa-search"></i> Buscar </button>
</form>
<form class="example" method="post" action="#">
    <input type="hidden" name="limpiar" id="limpiar" value="1">
    <button class="w3-btn w3-green w3-right" type="submit">Limpiar Busqueda </button>
</form>
<br>
<div class="w3-container w3-center">
<?php if($administrador!=null){
?>
    <a class="w3-btn w3-light-blue w3-left " href="<?php echo RECURSOS_PATH.'agregar_pokemon.php';?>">AGREGAR NUEVO POKEMON</a>
    <br><br><br>
<?php }

buscar_pokemon($conn,$criterio,$limpiar,$administrador);
cerrar_conexion($conn);
?>
</div>

<?php
include_once ($ruta."footer.php");
?>