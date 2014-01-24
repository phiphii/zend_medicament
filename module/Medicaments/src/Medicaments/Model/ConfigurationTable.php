<?php
namespace Medicaments\Model;

use Zend\Db\TableGateway\TableGateway;

class ConfigurationTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getConfiguration($id)
    {
        $id     = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row    = $rowset->current();
        if (!$row)
        {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveConfiguration(Configuration $configuration)
    {
        $data = array(
                    'config_file' => $configuration->config_file,
                    'environment' => $configuration->environment,
                );

        $id = (int)$configuration->id;

        if ($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if ($this->getConfiguration($id))
            {
                $this->tableGateway->update($data, array('id' => $id));
            }
            else
            {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteConfiguration($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}