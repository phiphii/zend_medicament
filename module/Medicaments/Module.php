<?php
namespace Medicaments;

use Medicaments\Model\Medicaments;
use Medicaments\Model\MedicamentsTable;
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
        return array(
            'factories' => array(
                'Medicaments\Model\MedicamentsTable' =>  function($sm) {
                    $tableGateway = $sm->get('MedicamentsTableGateway');
                    $table        = new MedicamentsTable($tableGateway);
                    return $table;
                },
                'MedicamentsTableGateway' => function ($sm) {
                    $dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicaments());
                    return new TableGateway('medicaments', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
