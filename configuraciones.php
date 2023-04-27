<?php 

/* Aquí se incluirían configuraciones de la tabla "configuración" (si existiera)
 * para establecer ciertos parámetros, como: mostrar errores, nombre del script
 * guardar sessiones, url del script, etc.
 */

// Mostrar todos los errores
error_reporting(E_ALL);

// Registrar los errores en un archivo en la misma carpeta que el script
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "/error.log");


/* 
 * URL del script
 * Dejar solo http://localhost/ si el script se encuentra en la raiz
 */
$sitio['url'] = 'http://finmyfbid.test/';
/**
 * Nombre del Script
 */
$sitio['nombre'] = 'Login Basico';

/* Sitios permitidos sin estar logueado */
$sitios_permitidos = array('registrar', 'login', 'find');
?>