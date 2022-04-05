<?php

class Racional
{
    //Declaro las propiedades

    private $num;
    private $den;

    //Constructor

    public function __construct($numerador = 1, $denominador = 1)
    {
        // Verificamos casos especiales
        // Si llega valor null, ""
        // que el denominador no sea 0
        $numerador =($numerador===null) || ($numerador==="") ? 1 : $numerador;
        $denominador=empty($denominador) ? 1 : $denominador;

        if (is_string($numerador)){
            $expresion ="#^[\-0-9]*/?[0-9]*$#";
            $ok = preg_match($expresion, $numerador);
            $numero = $ok ? explode("/",$numerador) : [1,1];
            $numerador = $numero[0];
            $denominador = $numero[1] ?? 1;
        }
        $this->num = $numerador;
        $this->den = $denominador;
    }

    public function __toString()
    {
        return "$this->num/$this->den";
    }

    public function sumar (Racional $operador2): Racional{
        $den = $this->den* $operador2->den;

        $num = $this->num*$operador2->den  +  $this->den*$operador2->num;

        $rtdo = new Racional($num, $den);

        return $rtdo;


    }
    public function restar (Racional $operador2): Racional{
        $den = $this->den* $operador2->den;

        $num = $this->num*$operador2->den  -  $this->den*$operador2->num;

        $rtdo = new Racional($num, $den);

        return $rtdo;


    }
    public function multiplicar (Racional $operador2): Racional{
        $den = $this->den* $operador2->den;
        $num = $this->num* $operador2->num;

        $rtdo = new Racional($num, $den);

        return $rtdo;


    }
    public function dividir (Racional $operador2): Racional{
        $den = $this->den* $operador2->num;
        $num = $this->num* $operador2->den;

        $rtdo = new Racional($num, $den);

        return $rtdo;


    }


}