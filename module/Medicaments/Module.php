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

    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()
          ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e){
            // Getting the controller object
            $controller      = $e->getTarget();
            // Getting the class of the controller, which matches the path to our controller
            $controllerClass = get_class($controller);
            // Getting the module namespace, can be usefull
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            
            // Get the action name
            $routeMatch      = $e->getRouteMatch();
            $actionName      = strtolower($routeMatch->getParam('action', 'not-found'));

            // Dispatching the variables to the layout
            $controller->layout()->moduleNamespace = $moduleNamespace;
            $controller->layout()->controllerName  = $controllerClass;
            $controller->layout()->actionName      = $actionName;
          }, 100);
    }
}
