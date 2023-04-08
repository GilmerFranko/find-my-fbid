<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

Class FindMyId{

  /* Contiene la instancia del controlador de remoto de WebDriver */
  public $driver;
  /**/
  public $data = array();

  public function __construct($serverUrl, $url)
  {
    $this->createWebDriver($serverUrl, $url);

    $this->data = array(
      'name' => $this->getFBName(),
      'fbid' => $this->getFBID(),
      'verified' => true,
    );

    $this->driver->quit();
  }

  public function createWebDriver($serverUrl, $url)
  {

    // Configurar opciones de Chrome
    $options = new ChromeOptions();
    //$options->addArguments(['--disable-gpu','--headless']);

    // Configurar opciones de DesiredCapabilities
    $capabilities = DesiredCapabilities::chrome();
    $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

    // Crear una instancia del controlador remoto de WebDriver usando Chrome
    $this->driver = RemoteWebDriver::create($serverUrl, $capabilities);

    // Go to URL
    $this->driver->get($url);

  }

  /**
   * Extrae Nombre del usuario
   */
  public function getFBName()
  {
    /* Contiene las etiquetas en las cuales se almacena
     * el nombre del usuario en el HTML
     */
    $tags = array('._391s');
    $countTags = count($tags);
    for($i = 0;$i < $countTags; $i++)
    {
      try
      {
        /* Busca el nombre del usuario */
        $Username = $this->driver->findElement(
          WebDriverBy::cssSelector($tags[$i])
        );

        $username = $Username->getText();
        if($username != NULL AND $username != '' AND !empty($username))
        {
          /* Devuelve FBName */
          return $username;
        }
        continue;
      }
      catch (Exception $e)
      {
        //error_log($e);
        continue;
      }
      break;
    }

  }

  /**
   * Extrae FBID
   */
  public function getFBID()
  {
    /* Contiene las etiquetas en las cuales se almacena
     * el nombre del usuario en el HTML
     */
    $tags = array('._55sr');
    $countTags = count($tags);
    for($i = 0;$i < $countTags; $i++)
    {
      try
      {
        $childElement = $this->driver->findElement(
          WebDriverBy::cssSelector($tags[$i])
        );

        // Encontrar el padre del elemento hijo
        $FBID = $childElement->findElement(WebDriverBy::xpath('..'));

        /* Busca el id del usuario */
        $fbid = $FBID->getAttribute('href');

        /* Devuelve FBID */
        return $fbid;
      }
      catch (Exception $e)
      {
        continue;
      }
      break;
    }
  }

  public function getUserVerified()
  {
    /* Contiene las etiquetas en las cuales se almacena
     * el nombre del usuario en el HTML
     */
    $tags = array('.bv');
    $countTags = count($tags);

    /* Extrae si el usuario está verificado */
    // Verificar si existe un elemento con un ID determinado
    if ($Username->findElements(WebDriverBy::cssSelector($tags[$i]))) {
      $verified = true;
    } else {
      $verified = false;
    }

    return $verified;
  }
}




?>
