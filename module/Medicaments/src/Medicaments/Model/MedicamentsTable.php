<?php
namespace Medicaments\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class MedicamentsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if($paginated) {
            $select             = new Select('medicaments');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Medicaments());
            $paginatorAdapter   = new DbSelect($select, $this->tableGateway->getAdapter(), $resultSetPrototype);
            $paginator          = new Paginator($paginatorAdapter);
            return $paginator;
        }
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
                    'name'             => $medicament->name,
                    'molecule'         => $medicament->molecule,
                    'indications'      => $medicament->indications,
                    'cons_indications' => $medicament->cons_indications,
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