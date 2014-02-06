<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Session\Container;
use Zend\Debug\Debug;
require_once('vendor/zendframework/spyc/Spyc.php');

$session = new Container('configuration');

if($session->offsetExists('config_file'))
{
	switch ($session->config_file) {
		case 'php':
			$data = new Zend\Config\Config(require 'config/config.php');
			break;

		case 'ini':
			$reader = new Zend\Config\Reader\Ini();
			$data = $reader->fromFile('config/config.ini');			
			break;

		case 'xml':
			$reader = new Zend\Config\Reader\Xml();
			$data = $reader->fromFile('config/config.xml');
			break;

		case 'yaml':
			$reader = new Zend\Config\Reader\Yaml(array('Spyc', 'YAMLLoadString'));
			$data = $reader->fromFile('config/config.yaml');
			break;

		case 'json':
			$reader = new Zend\Config\Reader\Json();
			$data = $reader->fromFile('config/config.json');
			break;
		
		default:
			$data = new Zend\Config\Config(require 'config/config.php');
			break;
	}
}else{
	$data = new Zend\Config\Config(require 'config/config.php');
}

if($session->offsetExists('environment'))
{
	$environment = $session->environment;
}
else
{
	$environment = 'production';
}

$webhost  = $data[$environment]['webhost'];
$database = $data[$environment]['database'];
$adapter  = $database['adapter'];
$host     = $database['params']['host'];
$dbname   = $database['params']['dbname'];
$user     = $database['params']['user'];
$password = $database['params']['password'];

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=' . $dbname . ';host=' . $host,
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
