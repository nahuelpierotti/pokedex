<?php
require_once("header.php");
$numero=isset($_GET["n"])?$_GET["n"]:null;
$imagen=isset($_GET["im"])?$_GET["im"]:null;
$resultado="";
if($numero!=null && $imagen!=null){
    $resultado=borrarPokemon($conn,$numero,$imagen);
?>
    <div class="w3-panel w3-green">
        <h3><?php echo $resultado;?></h3>
    </div>
<?php
}else{
?>
    <div class="w3-panel w3-yellow">
        <h3>Hubo un error al identificar el pokemon</h3>
    </div>
<?php
}

