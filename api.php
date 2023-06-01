<?php
    session_start();
    if (!isset($_SESSION['sistema'])) {
        $_SESSION['sistema'] = '';
};

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["numero"])) {
        $numero = $_POST["numero"];
        echo $numero;
        $_SESSION['sistema'] .= $numero;
    
    }
    if (isset($_POST["operation"])) {
        $operation = $_POST["operation"];
        if (isset($operation)) {
            $_SESSION['sistema'] .= $operation;
        }
    }
    if (isset($_POST["Resultado"])) {
        $numeros = $_SESSION['sistema'];
        if (isset($numeros)) {
            $resultado = eval("return $numeros;");
            $_SESSION['sistema'] = $resultado;

        }
    }
};
if(isset($_POST["borrar"])){
    $_SESSION['sistema'] = '';
}
var_dump ($_SESSION['sistema']);
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
        <input type="text" class="pantalla" name="inputNumerico" value="<?php  echo  isset($_SESSION['sistema']) ? $_SESSION['sistema'] : '0'; ?>"  readonly>
        <br>
        <table>
            <tr>
                <td><button type="submit" name="numero" value="7"> 7 </button></td>
                <td><button type="submit" name="numero" value="8"> 8 </button></td>
                <td><button type="submit" name="numero" value="9"> 9 </button></td>
                <td><button type="submit" name="operation" value="/"> % </button></td>
                
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="4"> 4 </button></td>
                <td><button type="submit" name="numero" value="5"> 5 </button></td>
                <td><button type="submit" name="numero" value="6"> 6 </button></td>
                <td><button type="submit" name="operation" value="*"> * </button></td>
                
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="1"> 1 </button></td>
                <td><button type="submit" name="numero" value="2"> 2 </button></td>
                <td><button type="submit" name="numero" value="3"> 3 </button></td>
                <td><button type="submit" name="operation" value="-"> - </button></td>

            </tr>
            <tr>
                <td><button type="submit" name="numero" value="0"> 0 </button></td>
                <td><button type="submit" name="numero" value="."> . </button></td>
                <td><button type="submit" name="Resultado" value="="> = </button></td>
                <td><button type="submit" name="operation" value="+"> + </button></td>
            </tr>
            <tr>
                <td><button type="submit" name="borrar" value="C">  C </button></td>
            </tr>
        </table>
    </form>
</body>
</html>

