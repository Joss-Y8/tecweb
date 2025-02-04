<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
    <h2>Ejercicio 2</h2> 
    <p>Proporcionar los valores de $a, $b, $c como sigue:
        <br> $a = "ManejadorSQL"; 
        <br> $b = 'MySQL'; 
        <br> $c = &$a; </p>
        <?php
            $a = "ManejadorSQL"; 
            $b = 'MySQL'; 
            $c = &$a; 
             
            echo '<ol>';
            echo '<li> Ahora muestra el contenido de cada variable </li>';
            echo '<ul>'; 
            echo "$a";
            echo '<br>';  
            echo "$b"; 
            echo '<br>';
            echo "$c"; 
            echo '</ul>';
            echo '<li> Agrega al código actual las siguientes asignaciones: 
            <br> $a = "PHP server";
            <br> $b = &$a; </li>'; 

            $a = "PHP server"; 
            $b = &$a;
            echo '<li> Vuelve a mostrar el contenido de cada uno</li>'; 
            echo '<ul>'; 
            echo "$a";
            echo '<br>';  
            echo "$b"; 
            echo '<br>';
            echo "$c"; 
            echo '</ul>';

            echo '<li> Describe y muestra en la página obtenida que ocurrió en el segundo bloque de asignaciones</li>'; 
            echo '<h4>Respuesta:</h4>';
            echo '<p> En el primer bloque de asignaciones a contaba con el valor de "ManejadorSQL", en el segundo bloque se actualiza a ';
            echo "$a"; 
            echo ', $b ahora es una referencia a $a, esto quiere decir que cualquier cambio en $a se refleja también en $b. Se tiene en cuenta que $c 
                 también es una referencia a $a por lo tanto cualquier cambio en la varible $a afecta directamente a las variables con una referencia a ella</p>'; 
        ?>

    <h2>Ejercicio 3</h2> 
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación, 
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglos): 
        <br> $a = "PHP5"; 
        <br> $z[] = &$a;  
        <br> $b = "5a version de PHP"; 
        <br> $c = $b*10; 
        <br> $a .= $b; 
        <br> $b *= $c; 
        <br> $z [0] = "MySQL";</p>

        <?php 
            echo '<h4>Respuesta</h4>'; 
            $a = "PHP5"; 
            echo "$a"; 
            echo '<br>';

            $z[] = &$a;
            print_r($z); 
            echo '<br>';

            $b = "5a version de PHP";
            echo "$b";
            echo '<br>';

            @$c = $b*10;
            echo "$c"; 
            echo '<br>';

            $a .= $b;
            echo "$a";  
            echo '<br>';

            @$b *= $c;
            echo "$b";
            echo '<br>';

            $z[0] = "MySQL";
            print_r($z); 
            echo '<br>';

             /*Resultado en PHP tester: 
                PHP5
                Array ( [0] => PHP5 )
                5a version de PHP
                50
                PHP55a version de PHP
                250
                Array ( [0] => MySQL ) */
        ?>
    
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
        <?php 
            unset($a, $b, $c, $z);
            $a = "PHP5"; 
            $z[] = &$a;  
            $b = "5a version de PHP"; 
            @$c = $b*10; 
            $a .= $b; 
            @$b *= $c; 
            $z[0] = "MySQL";

                function mostrarValor(){
                    echo 'Valor de $a: ' . $GLOBALS['a'];
                    echo '<br>'; 
                    echo 'Valor de $b: ' . $GLOBALS['b'];
                    echo '<br>';
                    echo 'Valor de $c: ' . $GLOBALS['c'];
                    echo '<br>';
                    print_r($GLOBALS['z']); 
                    echo '<br>';
                }
                //llamada a la función 
                echo '<h4>Respuesta</h4>'; 
                mostrarValor(); 
        ?>
    
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script: 
        <br>$a = “7 personas”;
        <br>$b = (integer) $a;
        <br>$a = “9E3”;
        <br>$c = (double) $a;</p>

        <?php
            echo '<h4>Respuesta</h4>';
            $a = "7 personas";
            echo 'valor de $a: '; 
            echo "$a";
            echo '<br>';

            $b = (integer) $a;
            echo 'valor de $b: '; 
            echo "$b";
            echo '<br>';

            $a = "9E3";
            echo 'valor de $a: '; 
            echo "$a";
            echo '<br>';

            $c = (double) $a;
            echo 'valor de $c: '; 
            echo "$c";
            echo '<br>';  
        ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comporbar el valor boolenao de las variables $a, $b, $c, $d, $e, $f
        y muéstralas usando la función var_dump(<datos>).
        <br>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:</p>

        <?php
            $a = "0";
            $b = "TRUE";
            $c = FALSE;
            $d = ($a OR $b);
            $e = ($a AND $c);
            $f = ($a XOR $b);

            echo '<h4>Respuesta</h4>';
            echo 'Valor de $a: '; 
            var_dump($a); 
            echo '<br>';
            echo 'Valor de $b: ';
            var_dump($b); 
            echo '<br>';
            echo 'Valor de $c: ';
            var_dump($c); 
            echo '<br>';
            echo 'Valor de $d: ';
            var_dump($d); 
            echo '<br>';
            echo 'Valor de $e: ';
            var_dump($e); 
            echo '<br>';
            echo 'Valor de $f: ';
            var_dump($f); 
            echo '<br>';

            echo '<h4> La función var_export() retorna una representación en cadena del valor para ser mostrado facilmente con un echo: </h4>'; 
            echo 'Valor de $c: ';
            echo var_export($c, true); 
            echo '<br>';
            echo 'Valor de $e: ';
            echo var_export($e, true); 
            echo '<br>';
        ?>
</body>

</html>