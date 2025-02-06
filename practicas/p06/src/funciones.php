<?php

    function multiplo($num) {
        if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
    }

    function generacion_repetitiva(){
        $mtz=[]; 
        $iteracion = 0; 
        $numeros = 0; 

        do{
            $iteracion++; 
            $fila = [rand(100,999), rand(100,999), rand(100,999)]; 
            $numeros +=3; 
            $mtz[]=$fila; 
        }while (!($fila[0]%2 !=0 && $fila[1]%2==0 && $fila[2]%2!=0)); 

        foreach($mtz as $fila){
            echo implode(", ", $fila).'<br>'; 
        }
        echo '<br>'; 

        echo "\n$numeros números obtenidos en $iteracion iteraciones";
    } 

    function entero_aleatorio($num){
        if ($num <= 0) {
            echo "Inserte un número mayor que 0";
            return;
        }
        $aleatorio = rand(1,1000); 
        
        while($aleatorio % $num != 0){
            $aleatorio = rand (1, 1000); 
        }
        echo "Número aleatorio generado: $aleatorio <br>";
        echo "¡El número $aleatorio es múltiplo de $num!<br>"; 
    }

    function aleatorio_do($numero_dado) {
        if ($numero_dado <= 0) {
            echo "Por favor, ingrese un número mayor que 0.";
            return;
        }
    
        $numero_aleatorio = 0;
    
        do {
            $numero_aleatorio = rand(1, 1000);
        } while ($numero_aleatorio % $numero_dado != 0); 
    
        echo "Número aleatorio generado: $numero_aleatorio<br>";
        echo "¡El número $numero_aleatorio es múltiplo de $numero_dado!<br>";
    }

    function arregloAscii(){
        $indices=[]; 
        for($i=97; $i<=122; $i++){
            $indices[$i] = chr($i); 
        }
        
        //Mostramos la tabla en XHTML 
        echo "<table>"; 
        echo "<tr><th>'Indice</th><th>Letra</th></tr>";
        foreach ($indices as $key =>$value){
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    }

    function identificarPersona($edad, $sexo){
        if($sexo=="Femenino" && $edad >=18 && $edad <=35){
            return "Bienvenida, usted está en el rango de edad apropiado."; 
        }
        else{
            return "Lo sentimos, no cumple con nuestros criterios."; 
        }
    }
?>