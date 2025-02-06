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
        
        if($sexo=="femenino" && $edad >=18 && $edad <=35){
            return "Bienvenida, usted está en el rango de edad apropiado."; 
        }
        else{
            return "Lo sentimos, no cumple con nuestros criterios."; 
        }
    }

    $parqueVehicular = array(
        'UBN6338' => array(
            'auto' => array(
                'marca' => 'HONDA',
                'modelo' => '2020', 
                'tipo' => 'Camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Alfonzo Esparza',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'C.U., Jardines de San Manuel'
            )
        ), 
        'UBN6339' => array(
            'auto' => array(
                'marca' => 'MAZADA',
                'modelo' => '2019', 
                'tipo' => 'Sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Ma. del consuelo Molina',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => '97 oriente'
            )
        ),
        'GHJ9012' => array(
            'auto' => array(
                'marca' => 'Toyota',
                'modelo' => '2021', 
                'tipo' => 'Sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Juan Pérez',
                'ciudad' => 'Cholula, Pue.',
                'direccion' => 'Av. Hidalgo 123'
            )
        ),
        'KLM3456' => array(
            'auto' => array(
                'marca' => 'FORD',
                'modelo' => '2018', 
                'tipo' => 'Hachback'
            ),
            'Propietario' => array(
                'nombre' => 'Laura García',
                'ciudad' => 'Atlixco, Pue.',
                'direccion' => 'Calle Flores 456'
            )
        ),
        'NOP7890' => array(
            'auto' => array(
                'marca' => 'Chevrolet',
                'modelo' => '2020', 
                'tipo' => 'Camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Carlos Martinez',
                'ciudad' => 'Tehuacán, Pue.',
                'direccion' => 'Av. Reforma'
            )
        ),
        'QRS2345' => array(
            'auto' => array(
                'marca' => 'Nissan',
                'modelo' => '2022', 
                'tipo' => 'Sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Ana López ',
                'ciudad' => 'San Andrés Cholula, Pue.',
                'direccion' => 'Av. Revolución 312'
            )
        ),
        'TUV9875' => array(
            'auto' => array(
                'marca' => 'Kia',
                'modelo' => '2019', 
                'tipo' => 'hachback'
            ),
            'Propietario' => array(
                'nombre' => 'Pedro Ramírez',
                'ciudad' => 'Huauchinango, Pue.',
                'direccion' => 'Calle Juárez 1765'
            )
        ),
        'WXY1234' => array(
            'auto' => array(
                'marca' => 'Hyundai',
                'modelo' => '2021', 
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Sofia Hernández',
                'ciudad' => 'San Martín Texmelucan, Pue.',
                'direccion' => 'Calle Morelos 987'
            )
        ),
        'ZAB6548' => array(
            'auto' => array(
                'marca' => 'MITSUBISHI',
                'modelo' => '2020', 
                'tipo' => 'Sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Diego Torres',
                'ciudad' => 'Tehuacán, Pue.',
                'direccion' => 'Las Palmas'
            )
        ),
        'CDE5874' => array(
            'auto' => array(
                'marca' => 'VOLKSWAGEN',
                'modelo' => '2018', 
                'tipo' => 'Hachback'
            ),
            'Propietario' => array(
                'nombre' => 'María Fernández',
                'ciudad' => 'Amozoc, Pue.',
                'direccion' => 'Calle Hidalgo'
            )
        ),
        'FGH3456' => array(
            'auto' => array(
                'marca' => 'Audi',
                'modelo' => '2021', 
                'tipo' => 'Sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Guillermo Hernnadez',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Huexotitla'
            )
        ),
        'IJA3654' => array(
            'auto' => array(
                'marca' => 'Bmw',
                'modelo' => '2019', 
                'tipo' => 'Camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Valeria Reyes',
                'ciudad' => 'Tecamachalco, Pue.',
                'direccion' => 'Av. Central'
            )
        ),
        'CHI2889' => array(
            'auto' => array(
                'marca' => 'Mercedes',
                'modelo' => '2020', 
                'tipo' => 'hachback'
            ),
            'Propietario' => array(
                'nombre' => 'Johan Reyes',
                'ciudad' => 'Tehuacán, Pue.',
                'direccion' => 'Zona ALta'
            )
        ),
        'HOY2257' => array(
            'auto' => array(
                'marca' => 'Honda',
                'modelo' => '2005', 
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'David Ramirez',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'San Baltazar'
            )
        ),
        'LRF2566' => array(
            'auto' => array(
                'marca' => 'Jeep',
                'modelo' => '2023', 
                'tipo' => 'Camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Metzli Barrera',
                'ciudad' => 'Tehuacan, Pue.',
                'direccion' => 'Los Pinos'
            )
        ),
    );

    
    function autoMatricula($matricula){
        global $parqueVehicular;
        if (array_key_exists($matricula, $parqueVehicular)) {
            $auto = $parqueVehicular[$matricula];
            echo "<h2>Información del Auto</h2>";
            echo "<p>Matrícula: $matricula</p>";
            echo "<p>Marca: " . $auto["auto"]["marca"] . "</p>";
            echo "<p>Modelo: " . $auto["auto"]["modelo"] . "</p>";
            echo "<p>Tipo: " . $auto["auto"]["tipo"] . "</p>";
            echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
            echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
            echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
        } else {
            echo "<p>La matrícula no existe en el registro.</p>";
        }
    }

    function mostrarAutos() {
        global $parqueVehicular;
        foreach ($parqueVehicular as $matricula => $auto) {
            echo "<h3>Matrícula: $matricula</h3>";
            echo "<p>Marca: " . $auto["auto"]["marca"] . "</p>";
            echo "<p>Modelo: " . $auto["auto"]["modelo"] . "</p>";
            echo "<p>Tipo: " . $auto["auto"]["tipo"] . "</p>";
            echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
            echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
            echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
            echo "<hr>";
        }
    }
?>