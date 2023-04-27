<?php
/**
 * Archivo que se encarga de abrir las instancias de Webdriver
 */

use Symfony\Component\Process\Process;

// Cargar la biblioteca Selenium WebDriver para PHP
require_once('../engine/selenium/vendor/autoload.php');


function initWebDriver($port = 9515)
{


  // Ruta al archivo webdriver.exe
  $webdriverPath = "chromedriver.exe";

  // Comando para iniciar webdriver con el nuevo puerto
  $command = [$webdriverPath, "--port=$port"];

  // Crear proceso y ejecutar comando
  $process = new Process($command);
  $process->start();

  // Esperar a que el proceso termine
  //$process->wait();

  // Verificar si hubo algún error
  if ($process->isSuccessful()) {
    echo "Webdriver iniciado en el puerto $port.";
  } else {
    echo "Error al iniciar webdriver en el puerto $port: " . $process->getErrorOutput();
  }
}

