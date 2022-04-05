<?php


class OperacionReal extends Operacion
{
    public function __construct(string $cadena) {
        parent::__construct($cadena);
    }
    public function calcula() { // devuelve un número que es el resultado de la operación
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
        $msj="<p>Soy una operación REAL</p>";
        $msj.="<p>Con contenido Op1: $this->op1; Op2: $this->op2; Operando: $this->operador;</p>";
        return $msj;
    }
    public function almacena(string $resultado): array {
        $historia[0]=$this->op1;
        $historia[1]=$this->op2;
        $historia[2]=$this->operador;
        $historia[3]=$resultado;
        return $historia;
    }
}
