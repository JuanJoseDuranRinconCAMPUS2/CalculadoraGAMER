<?php
    session_start();
    if (!isset($_SESSION['Numeros'])) {
        $_SESSION['Numeros'] = '';
        $_SESSION['valor1'] = '';
        $_SESSION['valor2'] = '';

    };

    $num1 = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["numero"])) {
            $numero = $_POST["numero"];
            echo $numero;
            $_SESSION['Numeros'] .= $numero;
        
        }
        if (isset($_POST["operacion"])) {
            $_SESSION['valor1'] = $_SESSION['Numeros'];
            $operation = $_POST["operacion"];
            $_SESSION['Numeros'] = '';
        }
        if(isset($_POST["Resultado"])){
            $_SESSION['valor2'] = $_SESSION['Numeros'];
            $_SESSION['Numeros'] = '';

            
        }
    };
    if(isset($_POST["borrar"])){
        $_SESSION['Numeros'] = '';
        $_SESSION['valor1'] = '';
        $_SESSION['valor2'] = '';
    }
    
    echo "data ingresada <br>";
    var_dump ($_SESSION['Numeros']);
    echo "<br> valor 1 <br>";
    var_dump ($_SESSION['valor1']);
    echo "<br> valor 2 <br>";
    var_dump ($_SESSION['valor2']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Datos</title>
</head>
<body>
    <!-- idea: los botones van a insertar data en el input "pantalla" esto evitando problemas con la recarga de data-->
    <form action="api.php" method="POST" id="calculator">
        <input type="text" class="pantalla" name="inputNumerico" value="<?php  echo  isset($_SESSION['Numeros']) ? $_SESSION['Numeros'] : '0'; ?>"  readonly>
        <br>
        <table>
            <tr>
                <td><button type="submit" name="numero" value="7"> 7 </button></td>
                <td><button type="submit" name="numero" value="8"> 8 </button></td>
                <td><button type="submit" name="numero" value="9"> 9 </button></td>
                <td><button type="submit" name="operacion" value="/"> % </button></td>
                
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="4"> 4 </button></td>
                <td><button type="submit" name="numero" value="5"> 5 </button></td>
                <td><button type="submit" name="numero" value="6"> 6 </button></td>
                <td><button type="submit" name="operacion" value="*"> * </button></td>
                
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="1"> 1 </button></td>
                <td><button type="submit" name="numero" value="2"> 2 </button></td>
                <td><button type="submit" name="numero" value="3"> 3 </button></td>
                <td><button type="submit" name="operacion" value="-"> - </button></td>

            </tr>
            <tr>
                <td><button type="submit" name="numero" value="0"> 0 </button></td>
                <td><button type="submit" name="numero" value="."> . </button></td>
                <td><button type="submit" name="Resultado" value="="> = </button></td>
                <td><button type="submit" name="operacion" value="+"> + </button></td>
            </tr>
            <tr>
                <td><button type="submit" name="borrar" value="C">  C </button></td>
            </tr>
        </table>
    </form>
</body>
</html>

