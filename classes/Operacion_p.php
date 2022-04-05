<?php

class Operacion
{


    private $op1;
    private $op2;
    private $operador;
    const REAL = 1;
    const RACIONAL = 2;
    const ERROR = 0;


    public static function tipo_operacion($cadena)
    {

//        2+2
//        2.2+2
//        2+2.2
//        2.2+2.2
        $expresion_real = "";
//        2/1+1
//        1+2/4
//        2/8+5/8
        $expresion_racional = "";
        $expresion_entero ="[1-9][0-9]*";
        $expresion_operador_racional ="\+|\-|\*|+:";
        $expresion_operador_real ="\+|\-|\*|\/";
        $expresion_racional ="$expresion_entero\/$expresion_entero";



        $expresion_racional_1 = "$expresion_racional$expresion_operador_racional$expresion_entero";
        $expresion_racional_2 = "$expresion_entero$expresion_operador_racional$expresion_racional";
        $expresion_racional_3 = "$expresion_racional$expresion_operador_racional$expresion_racional";

        if (preg_match("#^$expresion_racional_1$#", $cadena))
            return self::RACIONAL;
        if (preg_match("#^$expresion_racional_2$#", $cadena))
            return self::RACIONAL;
        if (preg_match("#^$expresion_racional_3$#", $cadena))
            return self::RACIONAL;


        public function __construct(string $cadena)
    {
        $this->operador = $this->obtenerOperador($cadena);
        $this->op1 = $this->obtenerOp1($cadena);
        $this->op2 = $this->obtenerOp2($cadena);
    }

        private function obtenerOperador(string $cadena)
    {
        $operador = "";

        if (strpos($cadena, '+') !== false)
            $operador = '+';
        else if (strpos($cadena, '-') !== false)
            $operador = '-';
        else if (strpos($cadena, '*') !== false)
            $operador = '*';
        else if (strpos($cadena, ':') !== false)
            $operador = ':';
        else
            $operador = '/';
        return $operador;


//        switch(true){
//            case strpos( $cadena,'+'):
//                $operador='+';
//                break;
//            case strpos( $cadena,'-'):
//                $operador='-';
//                break;
//            case strpos($cadena,'*'):
//                $operador='*';
//                break;
//            case strpos( $cadena,':'):
//                $operador=':';
//                break;
//            default:
//                $operador='/';
//        }
//        return $operador; //(+,-,*,:,/)
//    }

    }

        private function obtenerOp1(string $cadena)
    {
        $pos = strpos($cadena, $this->operador);

        $op1 = substr($cadena, 0, $pos);
        return $op1;

    }

        private function obtenerOp2(string $cadena)
    {

        $pos = strpos($cadena, $this->operador);
        $op2 = substr($cadena, $pos + 1);


        return $op2;
    }

        public function __toString()
    {
        $resultado = "Operando 1 = $this->op1<br />";   // TODO: Implement __toString() method.
        $resultado .= "Operando 2 = $this->op2<br />";   // TODO: Implement __toString() method.
        $resultado .= "Operador  = $this->operador<br />";   // TODO: Implement __toString() method.
        return $resultado;
    }


    }