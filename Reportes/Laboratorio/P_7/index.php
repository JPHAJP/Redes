<?php
// Definir la apikey
$API_KEY = '123';

// Comprobar si el archivo hola.txt existe, si no, crearlo con contenido inicial
if (!file_exists("hola.txt")) {
    file_put_contents("hola.txt", "0\r\n0");
}

// Leer el contenido del archivo
$ARCHIVO = file_get_contents("hola.txt");

// Encontrar la posición del primer salto de línea
$pos1 = strpos($ARCHIVO, "\r\n");

// Extraer las variables del contenido del archivo
$VAR1 = substr($ARCHIVO, 0, $pos1);
$VAR2 = substr($ARCHIVO, $pos1 + 2);

// Verificar si se ha pasado la apikey a través de GET
if (isset($_GET['apikey'])) {
    if ($_GET['apikey'] === $API_KEY) {
        // Verificar y sanitizar las entradas
        if (isset($_GET['A'])) {
            $VAR1 = htmlspecialchars($_GET['A'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_GET['B'])) {
            $VAR2 = htmlspecialchars($_GET['B'], ENT_QUOTES, 'UTF-8');
        }

        // Crear el texto a guardar en el archivo
        $TEXTO = $VAR1 . "\r\n" . $VAR2;

        // Guardar el texto en el archivo
        file_put_contents("hola.txt", $TEXTO);
    } else {
        echo "apikey inválida";
        exit;
    }
} else if (isset($_GET['apikey']) && $_GET['apikey'] !== $API_KEY) {
    echo "apikey inválida";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
    <meta http-equiv="refresh" content="5">
</head>
<body>
    <h3>A= <?php echo $VAR1; ?></h3>
    <h3>B= <?php echo $VAR2; ?></h3>
</body>
</html>