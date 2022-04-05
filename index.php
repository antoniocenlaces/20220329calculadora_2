<?php

    //Cargo el fichero que contiene la especificación
    spl_autoload_register(function ($clase) {
        require ("classes/$clase.php");
    });
    $cadena="";
    $msj="";
    $operacion=null;
    $historia=[];
    if (isset($_POST['f1'])) {
     $cadena=$_POST['cadena'] ?? "";
     $historia=$_POST['historia'] ?? [];
     $tipo_operacion=Operacion::tipo_operacion($cadena); //Real Racional Error
     switch ($tipo_operacion) {
         case Operacion::REAL1:
         case Operacion::REAL2:
         case Operacion::REAL3:
         case Operacion::REAL4:
             $operacion= new OperacionReal($cadena); // instancio un objeto operación real que tiene el método calcula
             $resultado=$operacion->calcula();
             $historia[]=$operacion->almacena(strval($resultado)); // guardo esta operación para mostrala en una tabla
             $msj="Una operación REAL de la cadena: $cadena. Con resultado: $resultado";
             break;
         case Operacion::RACIONAL1:
         case Operacion::RACIONAL2:
         case Operacion::RACIONAL3:
             $operacion= new OperacionRacional($cadena);
             $resultado=$operacion->calcula();
             $historia[]=$operacion->almacena($resultado); // guardo esta operación para mostrala en una tabla
             $msj="Una operación RACIONAL de la cadena: $cadena. Con resultado: $resultado";
             break;
         case Operacion::ERROR:
             $msj="Una operacion NO permitida";
     }
     $cadena=""; // vacío cadena para mostrarlo en el formulario
}
if (isset($_POST['f2'])) { // han pulsado en una línea de la tabla
    $cadena=$_POST['cadena'] ?? "";
    $historia=$_POST['historia'] ?? [];
    $cadena.=$historia[$_POST['f2']][3]; // pongo en $cadena el resultado de la línea pulsada
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" type="text/css" rel="stylesheet"> -->
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">String calculator</h1>
    </div>
    <div class="container mx-auto">
        <form method="POST" action="index.php">
            <fieldset>
                <legend>Flexible calculator input form.</legend>
                <div class="mb-3">
                    <label for="cadena" class="form-label">Introduce a string describing your operation:</label>
                    <input type="text" class="form-control" name="cadena" id="cadena" aria-describedby="cadenaHelp" value="<?=$cadena?>">
                    <div id="cadenaHelp" class="form-text">Operate with Integers, Real or Rational numbers. Valid operations are '+','-','*' or '/' for Integers and Real; '+','-','*', or ':' for Rational numbers.</div>
                </div>
                <button type="submit" name="f1" class="btn btn-primary">Enviar</button>
                <button type="submit" name="f1" class="btn btn-warning">Borrar</button>
            </fieldset>
            <?php
                foreach ($historia as $key => $value) {
                    echo "<input type='hidden' name='historia[$key][0]' value ='$value[0]'>\n"; // primer operando
                    echo "<input type='hidden' name='historia[$key][1]' value ='$value[1]'>\n"; // segundo operando
                    echo "<input type='hidden' name='historia[$key][2]' value ='$value[2]'>\n"; // Operador
                    echo "<input type='hidden' name='historia[$key][3]' value ='$value[3]'>\n"; // Resultado
            } ?>
        
            <div class="container mt-4">
                <h4>History of your operations.</h4>
                
                    <table class="table table-striped table-hover">
                        <tbody>
                            <thead>
                                <tr><th>Row</th><th class='text-center'>First Operand</th><th class='text-center'>Operator</th><th class='text-center'>Second Operand</th><th class='text-center'>Result</th><th class='text-center'>Recover</th></tr>
                            </thead>
                            <?php
                            foreach ($historia as $key => $value) {
                                $fila=$key+1;
                                echo "<tr><td>$fila</td><td class='text-center'>$value[0]</td><td class='text-center'>$value[2]</td><td class='text-center'>$value[1]</td><td class='text-center'>$value[3]</td><td class='text-center'><button type='submit' name='f2' class='btn btn-secondary' value='$key'>>>></button></td></tr>";
                            } ?>
                        </tbody>
                    </table>
                
            </div>
        </form>
    </div>
    <?php
        if ($msj!="")
            echo "<script type='text/javascript'>
        alert('$msj');
    </script>";
    ?>
<!-- <h3>La expresión: <span style="color=green;"><?=$cadena?></span></h3>
<h3><?=$msj?></h3>
<h4>El objeto Operación creado:</h4>
<h4><?=$operacion?></h4> -->
 <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
