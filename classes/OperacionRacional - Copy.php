<?php


class OperacionRacional extends Operacion
{
    public function __construct($cadena) {
        parent::__construct($cadena);
        $this->op1 = new Racional($this->op1);
        $this->op2=new Racional($this->op2);
    }
    public function calcula(): Racional {
        echo "<p>Estoy en calcula() de OperacionRacional.</p>";
        echo "<p>y he recibido $this->op1; $this->op2; $this->operador;</p>";
        $op1= $this->op1;
        $op2= $this->op2;
        echo "<p>Primer operador: $op1</p>";
        echo "<p>Segundo operador: $op2</p>";
        echo "<p>Operación: $this->operador</p>";
        switch ($this->operador) {
            case '+':
               return $op1->sumar($op2); // Estas operaciones devuelven un objeto Racional
                
            case '-':
                return $op1->restar($op2);
                
            case '*':
                return $op1->multiplicar($op2);
                
            case ':':
                return$op1->dividir($op2);
                
        }
        
        //retrun $resultado; // Retorna un objeto Racional
    }
     public function __toString() {
        $resultado=$this->calcula();
        $msj="Soy una operación RACIONAL<br>";
        $msj.="Con contenido Op1: $this->op1; Op2: $this->op2; Operando: $this->operador;<br>";
        $msj.="Cuyo resultado es: $resultado<br>";
        return $msj;
    }
}