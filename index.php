<?php
require_once ("recursos/header.php");
?>
<br>
<body>
<h1 class="w3-center">Pokedex</h1>
<br>
<form class="example" method="post" action="#">
    <input type="text" placeholder="Ingrese nombre, tipo o numero de pokemon.." name="criterio" id="criterio">
    <button class="w3-btn w3-light-blue" type="submit"><i class="fa fa-search"></i> Buscar </button>
</form>
<form class="example" method="post" action="#">
    <input type="hidden" name="limpiar" id="limpiar" value="1">
    <button class="w3-btn w3-green w3-right" type="submit">Limpiar Busqueda </button>
</form>
<br>
<div class="w3-container">
<?php
buscar_pokemon($conn,$criterio,$limpiar);
cerrar_conexion($conn);
?>
</div>
</body>
<?php
require_once ("recursos/footer.php");
?>