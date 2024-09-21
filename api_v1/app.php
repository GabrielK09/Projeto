<?php

// Exemplo simples
class A {
    public $b;
}

class B {
    public $a;
}

$a = new A();
$b = new B();

$a->b = $b;
$b->a = $a; // Criando um ciclo de referências

// Removendo referências
unset($a);
unset($b);

// Coletar ciclos de lixo
$coletados = gc_collect_cycles();

echo "Ciclos coletados: $coletados\n";
