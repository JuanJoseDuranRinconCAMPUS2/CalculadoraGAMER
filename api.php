<?php
    session_start();

    $seccionVariables = ['Numeros', 'valor1', 'valor2', 'Operacion'];
    foreach ($seccionVariables as $valor) {
        if (!isset($_SESSION[$valor])) {
            $_SESSION[$valor] = '';
        }
    }

    $num1 = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["numero"])) {
            $numero = $_POST["numero"];
            $_SESSION['Numeros'] .= $numero;
            if (substr($_SESSION['Numeros'], 0, 1) == $_SESSION['Operacion']) {
                $_SESSION['Numeros'] = substr($_SESSION['Numeros'], 1);
            }
        }
        if (isset($_POST["operacion"]) && is_numeric($_SESSION['Numeros'])) {
            $_SESSION['valor1'] = $_SESSION['Numeros'];
            $_SESSION['Operacion'] = $_POST["operacion"];
            $_SESSION['Numeros'] =  $_SESSION['Operacion'];
        }
        if(isset($_POST["Resultado"]) ){
            $_SESSION['valor2'] = $_SESSION['Numeros'];
            $_SESSION['Numeros'] = '';
            $num1 = isset($_SESSION['valor1']) ? $_SESSION['valor1'] : '0';
            $num2 = isset($_SESSION['valor2']) && is_numeric($_SESSION['valor2']) ? $_SESSION['valor2'] : '1';
            $operacion = $_SESSION['Operacion'];
            $_SESSION['Numeros'] = match($operacion) {
                "+" =>  strval($num1 + $num2),
                "-" =>  strval($num1 - $num2),
                "*" =>  strval($num1 * $num2),
                "/" =>  strval($num2 == "0" ? "No se puede dividir entre cero" : $num1 / $num2),
                "1/x" =>  strval($num1 == "0" ? "No se puede dividir entre cero" : "1" / $num1),
                "x^2" =>  strval($num1 ** "2"),
                "√x" =>  strval(sqrt($num1)),
                "%" =>  strval(sqrt($num2 == "0" ? "No se puede dividir entre cero" : $num1 % $num2)),
                default => $num1,
            };
        }
        if (isset($_POST["point"]) && is_numeric($_SESSION['Numeros'])) {
            if (strpos($_SESSION['Numeros'], '.') === false) {
                $_SESSION['Numeros'] .= ".";
            } else {
                $_SESSION['Numeros'] = rtrim($_SESSION['Numeros'], '.');
            }
        }
        if (isset($_POST["N/P"]) && is_numeric($_SESSION['Numeros'])) {
            if (substr($_SESSION['Numeros'], 0, 1) !== '-') {
                $_SESSION['Numeros'] = '-' . $_SESSION['Numeros'];
            } else {
                $_SESSION['Numeros'] = substr($_SESSION['Numeros'], 1);
            }
        }
    };
    if(isset($_POST["borrar"])){
        foreach ($seccionVariables as $valor) {
            $_SESSION[$valor] = '';
        }
    };
    if(isset($_POST["borrarUno"])){
        $_SESSION['Numeros'] = substr($_SESSION['Numeros'], 0, -1);  
    };
    
    // echo "data ingresada <br>";
    // var_dump ($_SESSION['Numeros']);
    // echo "<br> valor 1 <br>";
    // var_dump ($_SESSION['valor1']);
    // echo "<br> valor 2 <br>";
    // var_dump ($_SESSION['valor2']);
    // echo "<br> operacion <br>";
    // var_dump ($_SESSION['Operacion']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora</title>
</head>
<body>
    <div class="container">
    <svg viewBox="0 0 960 300">
        <symbol id="s-text">
        <text text-anchor="middle" x="50%" y="80%">Calculadora</text>
        </symbol>

        <g class = "g-ants">
        <use xlink:href="#s-text" class="text-copy"></use>
        <use xlink:href="#s-text" class="text-copy"></use>
        <use xlink:href="#s-text" class="text-copy"></use>
        <use xlink:href="#s-text" class="text-copy"></use>
        <use xlink:href="#s-text" class="text-copy"></use>
        </g>
    </svg>
    </div>
    <!-- idea: los botones van a insertar data en el input "pantalla" esto evitando problemas con la recarga de data-->
    <form action="api.php" method="POST" id="calculator">
        <input type="text" class="pantalla" name="inputNumerico" value="<?php  echo  isset($_SESSION['Numeros']) ? $_SESSION['Numeros'] : '0'; ?>"  readonly>
        <br>
        <table>
            <tr>
                <td><button class="botonCal" type="submit" name="operacion" value="%">  % </button></td>
                <td><button class="botonCal" type="submit" name="borrar" value="C">  C </button></td>
                <td><button class="botonCal" type="submit" name="borrar" value="CE">  CE </button></td>
                <td><button class="botonCal" type="submit" name="borrarUno" value="borrarUno">  <- </button></td>
            </tr>
            <tr>
                <td><button class="botonCal" type="submit" name="operacion" value="1/x"> 1/x </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="x^2"> x^2 </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="√x"> √x </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="/"> / </button></td>
            </tr>
            <tr>
                <td><button class="botonCal" type="submit" name="numero" value="7"> 7 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="8"> 8 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="9"> 9 </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="*"> X </button></td>
            </tr>
            <tr>
                <td><button class="botonCal" type="submit" name="numero" value="4"> 4 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="5"> 5 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="6"> 6 </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="-"> - </button></td>
            </tr>
            <tr>
                <td><button class="botonCal" type="submit" name="numero" value="1"> 1 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="2"> 2 </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="3"> 3 </button></td>
                <td><button class="botonCal" type="submit" name="operacion" value="+"> + </button></td>
            </tr>
            <tr>
                <td><button class="botonCal" type="submit" name="N/P" value="-/+">  -/+ </button></td>
                <td><button class="botonCal" type="submit" name="numero" value="0"> 0 </button></td>
                <td><button class="botonCal" type="submit" name="point" value="."> . </button></td>
                <td><button class="botonCal" type="submit" name="Resultado" value="="> = </button></td>
            </tr>
            
        </table>
    </form>
</body>
</html>

