<?php 
/* Este archivo incluye funciones basicas */

function redireccionar($ruta) {
    global $sitio;
    if (filter_var($ruta, FILTER_VALIDATE_URL)) {
        // Es una URL, redirigir a la URL
        header("Location: $ruta");
    } else {
        // Es una ruta de archivo local, agregar ".php" y redirigir a la ruta
        $ruta = $sitio['url'].'index.php?pagina='.$ruta;
        header("Location: $ruta");
    }
    exit();
}

/** Crea una URL */
function crearUrl($url)
{
    global $sitio;

    $ruta = $sitio['url'].'index.php?pagina='.$url;

    return $ruta;
}

 /**
 * Genera un identificador único
 */
 function generateUUID($length = 28)
 {
    $key = substr(md5(uniqid(true) . microtime()), 0, $length);
        //
    return $key;
}

?>