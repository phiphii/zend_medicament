<?php
namespace Medicaments;

use Medicaments\Model\Medicaments;
use Medicaments\Model\MedicamentsTable;
use Medicaments\Model\Configuration;
use Medicaments\Model\ConfigurationTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

    public function getServiceConfig()
    {
        /*
         * TableGateway definition:
         * public function __construct($table, Adapter $adapter, $features = null, ResultSet $resultSetPrototype = null, Sql $sql = null)
         */
        return array(
            'factories' => array(
                'Medicaments\Model\MedicamentsTable' =>  function($serviceManager) {
                    $tableGateway = $serviceManager->get('MedicamentsTableGateway');
                    $table        = new MedicamentsTable($tableGateway);
                    return $table;
                },
                'MedicamentsTableGateway' => function ($serviceManager) {
                    $dbAdapter          = $serviceManager->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicaments());
                    return new TableGateway('medicaments', $dbAdapter, null, $resultSetPrototype);
                },
                'Medicaments\Model\ConfigurationTable' =>  function($serviceManager) {
                    $tableGateway = $serviceManager->get('ConfigurationTableGateway');
                    $table        = new ConfigurationTable($tableGateway);
                    return $table;
                },
                'ConfigurationTableGateway' => function ($serviceManager) {
                    $dbAdapter          = $serviceManager->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Configuration());
                    return new TableGateway('configuration', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
