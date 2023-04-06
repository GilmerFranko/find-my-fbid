<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
// Cargar la biblioteca Selenium WebDriver para PHP
require_once('../engine/selenium/vendor/autoload.php');


class WebDriverThread extends Thread {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function run() {
         // Configurar opciones de Chrome
        $options = new ChromeOptions();
        $options->addArguments(['--disable-gpu','--headless']);

    // Configurar opciones de DesiredCapabilities
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

    // Crear una instancia del controlador remoto de WebDriver usando Chrome
        $serverUrl = 'http://localhost:9515';
        $driver = RemoteWebDriver::create($serverUrl, $capabilities);
        $driver = RemoteWebDriver::create($this->url, DesiredCapabilities::chrome());
        // Aquí puedes realizar tus acciones con WebDriver
        $driver->get('http://www.example.com');
        $driver->quit();
    }
}

// Crea un array con las URL que deseas abrir
$urls = array(
    'http://localhost:4444/wd/hub',
    'http://localhost:4445/wd/hub',
    'http://localhost:4446/wd/hub'
);

// Crea un array para almacenar los hilos
$threads = array();

// Inicia un hilo para cada URL
foreach ($urls as $url) {
    $thread = new WebDriverThread($url);
    $thread->start();
    $threads[] = $thread;
}

// Espera a que todos los hilos terminen antes de salir del script
foreach ($threads as $thread) {
    $thread->join();
}





$_GET['username'] = 'zuck';
if(isset($_GET['username']) AND is_string($_GET['username']))
{


    
    // Go to URL
    $driver->get('https://mbasic.facebook.com/' . $_GET['username']);

    $username = '';
    $fbid = '';

    /* Extrae Nombre del usuario */
    try
    {
        /* Busca el nombre del usuario */
        $Username = $driver->findElement(
            WebDriverBy::cssSelector('.bt')
        );
        $username = $Username->getText();
    }
    catch (Exception $e)
    {
        // Maneja el error sin cerrar la instancia de GeckoDriver
        echo 'Se produjo un error: ' . $e->getMessage();
    }


    /* Extrae FBID */
    try
    {
        $childElement = $driver->findElement(
            WebDriverBy::cssSelector('.ba')
        );

        // Encontrar el padre del elemento hijo
        $FBID = $childElement->findElement(WebDriverBy::xpath('..'));
        /* Busca el id del usuario */
        
        $fbid = $FBID->getAttribute('href');
    } 
    catch (Exception $e)
    {
        // Maneja el error sin cerrar la instancia de GeckoDriver
        echo 'Se produjo un error: ' . $e->getMessage();
    }

    /* Extrae si el usuario está verificado */
    // Verificar si existe un elemento con un ID determinado
    if ($Username->findElements(WebDriverBy::cssSelector('.bv'))) {
        $verified = true;
    } else {
        $verified = false;
    }

    // Make sure to always call quit() at the end to terminate the browser session
    $driver->quit();


    $data = array(
        'name' => $username,
        'fbid' => $fbid,
        'verified' => $verified,
    );

    echo var_export($data);

}





?>

