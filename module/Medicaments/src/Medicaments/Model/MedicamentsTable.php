<?php
namespace Medicaments\Model;

use Zend\Db\TableGateway\TableGateway;

class MedicamentsTable
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

    public function getMedicament($id)
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

    public function saveMedicament(Medicaments $medicament)
    {
        $data = array(
                    'name' => $medicament->name,
                );

        $id = (int)$medicament->id;

        if ($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if ($this->getMedicament($id))
            {
                $this->tableGateway->update($data, array('id' => $id));
            }
            else
            {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteMedicament($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}