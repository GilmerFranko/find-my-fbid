<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\WebDriverBrowserConnection;
use Facebook\WebDriver\Chrome\ChromeDevToolsDriver;
use Facebook\WebDriver\Chrome;

require_once('selenium/vendor/autoload.php');

$url = 'https://fast.com';
$serverUrl = 'http://localhost:9516';
// Configurar opciones de Chrome
$options = new ChromeOptions();
//$options->addArguments(['--disable-gpu','--headless']);

// Configurar opciones de DesiredCapabilities
$capabilities = DesiredCapabilities::chrome();
$capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
//$capabilities->setCapability('chromeOptions', ['args' => ['--incognito']]);

$driver = RemoteWebDriver::create('http://localhost:9515', $capabilities);

$devTools = new ChromeDevToolsDriver($driver);
// Limitar la velocidad de la red
$devTools->execute('Network.emulateNetworkConditions', [
	'offline' => false,
	'latency' => 60000,
    'downloadThroughput' => 50 * 1024 / 8, // Convertir kilobits a bytes
    'uploadThroughput' => 50 * 1024 / 8 // Convertir kilobits a bytes
  ]);
// Go to URL
$driver->get($url);
phpinfo();


?>
