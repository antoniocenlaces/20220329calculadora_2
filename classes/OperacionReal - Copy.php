<?php


class OperacionReal extends Operacion
{
    public function __construct(string $cadena) {
        parent::__construct($cadena);
    }
    public function calcula() {
        switch ($this->operador) {
            case '+':
                $resultado=$this->op1 +$this->op2;
                break;
            case '-':
                $resultado=$this->op1 -$this->op2;
                break;
            case '*':
                $resultado=$this->op1 *$this->op2;
                break;
            case '/':
                $resultado=$this->op1 /$this->op2;
                break;
        }
        return $resultado;
    }
    public function __toString() {
        $resultado=$this->calcula();
        $msj="Soy una operación REAL<br>";
        $msj.="Con contenido Op1: $this->op1; Op2: $this->op2; Operando: $this->operador;<br>";
        $msj.="Cuyo resultado es: $resultado<br>";
        return $msj;
    }
}
