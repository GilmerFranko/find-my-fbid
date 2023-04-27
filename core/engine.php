<?php

/**
 * @Author: gilme
 * @Date:   2023-02-25 20:41:04
 * @Last Modified by:   gilme
 * @Last Modified time: 2023-02-26 01:48:09
 */

// Inicializar CURL
$curl = curl_init();

// Establecer la URL y las opciones de CURL
curl_setopt($curl, CURLOPT_URL, "https://www.pelisplus2.io/pelicula/la-sentencia/"); // URL de la API
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Devolver la respuesta en lugar de imprimir en pantalla

// Ejecutar la petición CURL y obtener la respuesta
$response = curl_exec($curl);

// Comprobar si hubo algún error
if ($response === false) {
    echo "Error en la petición CURL: " . curl_error($curl);
} else {
    // La petición se ha realizado con éxito, procesar la respuesta
    echo "Respuesta de la API: " . $response;
}

echo $response;
// Cerrar CURL
curl_close($curl);
