<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;


/* Cargar la biblioteca Selenium WebDriver para PHP */
require_once('../engine/selenium/vendor/autoload.php');
/* Cargar la clase FindMyId */
require_once('find-my-id.class.php');

$_GET['username'] = 'zuck';
if(isset($_GET['username']) AND is_string($_GET['username']))
{

  initScraping('https://m.facebook.com/' . $_GET['username']);

}

function initScraping($facebook_url)
{


  // Define los puertos a utilizar
  $ports = array(9515, 9516, 9517, 9518);

  // Define la ruta del archivo de bloqueo
  $lock_file = 'webdriver.lock';

  // Realiza un muestreo de los puertos para ver cuál está disponible
  while (true) {
    foreach ($ports as $port)
    {

      try
      {
        // Se genera la url con el puerto a utilizar
        $serverUrl = 'http://localhost:' . $port;
        // Inicia el scraping
        $data = new FindMyId($serverUrl, $facebook_url);

        if($data == false)
        {
          continue;
        }
        else
        {
          break 2;
        }
      }
      catch (Exception $e)
      {
        error_log($e);
        continue;
      }

    }
    // Si llegamos aquí, significa que todas las instancias de WebDriver en los puertos especificados están ocupadas
    // Esperamos un período de tiempo antes de intentar nuevamente
    sleep(1);
  }



  echo var_export($data->data);
}




?>

