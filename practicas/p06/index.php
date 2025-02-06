<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
    <style> 
        table {
            border-collapse: collapse; 
            width: 50%;
            margin: 20px; 
        }
        th, td {
            border: 1px solid black; 
            padding: 8px; 
            text-aling: center; 
        }
        th{
            background-color: lightgray; 
        }
    </style>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        require_once __DIR__ .'/src/funciones.php'; 
        if(isset($_GET['numero']))
        {
            multiplo($_GET['numero']);
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
        secuencia compuesta por: impar, par, impar</p>
    <?php
        require_once __DIR__ .'/src/funciones.php';
        echo '<p>Los numeros generados son: <p>';
        generacion_repetitiva(); 
    ?>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
        pero que además sea multiplo de un número dado.
        <ul>
            <li>Crear una variante de este script utilizando el ciclo do-while</li>
            <li>El número dado se debe obtener vía GET.</li>
    </ul></p>
    <?php
        require_once __DIR__ .'/src/funciones.php';
        echo '<h3>Función creada con while</h3>';
        if(isset($_GET['nume']))
        {
            entero_aleatorio($_GET['nume']); 
        }

        echo '<h3>Función creada con do-while</h3>';
        if(isset($_GET['nume']))
        {
            aleatorio_do($_GET['nume']); 
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la 'a'
        a la 'z'. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para
        poner el valor en cada índice. Es decir: 
        <br>[97] => a
        <br>[98] => b
        <br>[99] => c
        <br>...
        <br>[122] => z
        <ul>
            <li>Crea el arreglo con un ciclo for</li>
            <li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</li>
    </ul></p>
    <?php
        require_once __DIR__ .'/src/funciones.php';
        echo "<h4>Mandamos a llamar a la funcion para mostrar la tabla del arreglo</h4>"; 
        arregloAscii(); 
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p06/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de 
        sexo "femenino", cuya edad oscile entre los 18 y 35 años, mostrar un mensaje de
        bienvenida apropiado. Por ejemplo: 
        <br>Bienvenida, usted está en el rango de edad permitido.
        <br>En caso contrario deberá devolverse otro mensaje indicando el error.
        <ul>
            <li>Los valores para $edad y $sexo se deben obtener por medio de un formulario en HTML.</li>
            <li>Utilizar la Variable Superglobal $_POST (revisar documentación).</li>
    </ul></p>
    <h3>Ingreso de datos</h3>
    <form action="http://localhost/tecweb/practicas/p06/index.php" method="post">
        <label for="edad">Edad: </label>
        <input type="number" name="edad" id="edad" required><br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
            <option value="otro">Otro</option>
        </select><br>

        <button type="submit">Enviar</button>
    </form>
    <?php
        // Incluir funciones externas
        require_once __DIR__.'/src/funciones.php';

        // Procesar el formulario cuando se envíe
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            // Verificar si los valores están presentes en $_POST
            if (isset($_POST['edad']) && isset($_POST['sexo'])) {
                // Obtener valores del formulario
                $edad = $_POST['edad'];
                $sexo = $_POST['sexo'];

                // Llamar a la función para identificar a la persona
                $mensaje = identificarPersona($edad, $sexo);

                // Mostrar el mensaje
                echo "<h3>Resultado:</h3>";
                echo "<p>$mensaje</p>";
            }
        }
    ?>

    <h2>Ejercicio 6 </h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
        una ciudad. Cada vehículo debe ser identificado por:
        <ul>
            <li>Matricula</li>
            <li>Auto</li>
            <ul>
                <li>Marca</li>
                <li>Modelo</li>
                <li>Tipo (sedan|hachback|camioneta)</li>
            </ul>
            <li>Propietario</li>
            <ul>
                <li>Nombre</li>
                <li>Ciudad</li>
                <li>Dirección</li>
            </ul>
        </ul> 
    <p>La matrícula debe tener el siguiente formato LLLNNNN, donde las L pueden ser letras de
    la A-Z y las N pueden ser números de 0-9.</p>
    

</body>
</html>