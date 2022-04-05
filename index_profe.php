<?php
function carga($clase){
    require("classes/$clase.php");
}

spl_autoload_register(carga);

$operacion = null;
$cadena ="1/8";
$tipo_operacon = Operacion_p::tipo_operacion($cadena);   // REAL RACIONAL ERROR

switch ($tipo_operacon){
    case Operacion_p::REAL:
        $operacion = new Operacion_p($cadena);
        $msj ="La operacion es Real";
        break;
    case Operacion_p::RACIONAL:
        $operacion = new Operacion_p($cadena);
        $msj ="La operacion es Racional";
        break;
    case Operacion_p::ERROR:
        $msj ="La operacion no es permitida";
}



echo "<h1>He creado un objeto a partir del string <span style='color:green'>$cadena</h1>";
echo "<h1>El tipo de operacion es $msj</h1>";
if (!is_null($operacion))
    echo "valor de operacion :<h2> $operacion</h2>";


?>
