<?php


abstract class Operacion
{
    protected $op1;
    protected $op2;
    protected $operador;
    protected $tipoOperacion;
    const REAL1=1;  // 2+2
    const REAL2=2;  // 2.2+2
    const REAL3=3;  // 2+2.2
    const REAL4=4;  // 2.2+2.2
    const RACIONAL1=5;  // 2/3+1
    const RACIONAL2=6;  // 1+2/4
    const RACIONAL3=7;  // 2/7+2/2
    const ERROR=0;
    public function __construct(string $cadena) {
        $this->tipoOperacion=self::tipo_operacion($cadena);
        if ($this->tipoOperacion!=self::ERROR) {
        $this->operador=$this->obtenerOperador($cadena);
        $this->op1=$this->obtenerOp1($cadena);
        $this->op2=$this->obtenerOp2($cadena);
        }
    }
    private function obtenerOperador(string $cadena) {
        // evaluo '-' antes de '/' para que se puedan poner números negativos en el segundo operando
        $caracteresOperacion= ['+','*',':','-','/'];
        switch ($this->tipoOperacion) {
            case self::REAL2:
            case self::REAL4:
                $cadena=substr($cadena,strpos($cadena,'.')+1);
                break;
            case self::RACIONAL1:
            case self::RACIONAL3:
                $cadena=substr($cadena,strpos($cadena,'/')+1);
                break;
        }
        $operador=false;
        foreach ($caracteresOperacion as $item) {
            $pos=strpos($cadena,$item);
            if ($pos!==false && $operador===false) {
                $operador = substr($cadena, $pos,1);
            }
        }
        return $operador;
    }
    private function obtenerOp1(string $cadena) {
        if (substr($cadena, 0,1)==='-') {
            $negativo=true;
            $cadena=substr($cadena, 1);
        } else {
            $negativo=false;
        }
        switch ($this->tipoOperacion) {
            case self::REAL1:
            case self::REAL3:
            case self::RACIONAL2:
                $resultado= explode($this->operador,$cadena)[0];
            case self::REAL2:
            case self::REAL4:
            case self::RACIONAL1:
            case self::RACIONAL3:
                $resultado= substr($cadena,0,strpos($cadena,$this->operador));
        }
        return $negativo ? "-".$resultado : $resultado;
    }
    private function obtenerOp2(string $cadena) {
        return substr($cadena,strlen($this->op1)+1,strlen($cadena)-strlen($this->op1));
    }
    public static function tipo_operacion(string $cadena) {
        // Posibilidades de REAL:
        // 2+2    Real 1
        // 2.2+2    Real 2
        // 2+2.2    Real 3
        //2.2+2.2    Real 4
        // Posibilidades de RACIONAL:
        // 2/3+1    Racional 1
        // 1+2/4    Racional 2
        // 2/7+2/2    Racional 3
 
        $expresion_entero ="[\-1-9][0-9]*";
        $expresion_positivo="[1-9][0-9]*";
        $expresion_operador_racional ="[\+|\-|\*|\:]{1}";
        $expresion_operador_real ="[\+|\-|\*|\/]{1}";
        $expresion_racional ="$expresion_entero\/$expresion_positivo";
        $expresion_real_decimal="[\-0-9]*\.[0-9]*";
        
        $expresion_real_1="$expresion_entero$expresion_operador_real$expresion_entero";
        $expresion_real_2="$expresion_real_decimal$expresion_operador_real$expresion_entero";
        $expresion_real_3="$expresion_entero$expresion_operador_real$expresion_real_decimal";
        $expresion_real_4="$expresion_real_decimal$expresion_operador_real$expresion_real_decimal";

        $expresion_racional_1 = "$expresion_racional$expresion_operador_racional$expresion_entero";
        $expresion_racional_2 = "$expresion_entero$expresion_operador_racional$expresion_racional";
        $expresion_racional_3 = "$expresion_racional$expresion_operador_racional$expresion_racional";

        if (preg_match("#^$expresion_racional_1$#", $cadena))
            return self::RACIONAL1;
        if (preg_match("#^$expresion_racional_2$#", $cadena))
            return self::RACIONAL2;
        if (preg_match("#^$expresion_racional_3$#", $cadena))
            return self::RACIONAL3;
        if (preg_match("#^$expresion_real_1$#", $cadena))
            return self::REAL1;
        if (preg_match("#^$expresion_real_2$#", $cadena))
            return self::REAL2;
        if (preg_match("#^$expresion_real_3$#", $cadena))
            return self::REAL3;
        if (preg_match("#^$expresion_real_4$#", $cadena))
            return self::REAL4;
        else 
            return self::ERROR;
    }
  abstract  public function __toString();

  abstract public function calcula();
}