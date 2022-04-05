<?php


class OperacionRacional extends Operacion
{
    public function __construct($cadena) {
        parent::__construct($cadena);
        $this->op1 = new Racional($this->op1);
        $this->op2=new Racional($this->op2);
    }
    public function calcula(): Racional {
        $op1= $this->op1;
        $op2= $this->op2;
        switch ($this->operador) {
            case '+':
               return $op1->sumar($op2); // Estas operaciones devuelven un objeto Racional
                
            case '-':
                return $op1->restar($op2);
                
            case '*':
                return $op1->multiplicar($op2);
                
            case ':':
                return $op1->dividir($op2);
                
        }
        
//        return $resultado; // Retorna un objeto Racional
    }
     public function __toString() {
        $msj="<p>Soy una operación RACIONAL</p>";
        $msj.="<p>Con dos objetos Racional: $this->op1; y: $this->op2; Operando: $this->operador;</p>";
        return $msj;
    }
     public function almacena(Racional $resultado): array {
        $historia[0]=$this->op1;
        $historia[1]=$this->op2;
        $historia[2]=$this->operador;
        $historia[3]="$resultado";
        return $historia;
    }
}