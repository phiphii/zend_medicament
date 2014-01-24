<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Medicaments\Form\MedicamentForm;

class IndexController extends AbstractActionController
{
    // var medicamentsTable needed in order to use database
	protected $medicamentsTable;

    public function indexAction()
    {
        // Initialize Zend\Session container in order to send it to our view
        $session = new Container('configuration');
        return new ViewModel(
		        		array(
		        			'session' => $session,
		        			'medicaments' => $this->getMedicamentsTable()->fetchAll(),
	        			)
		        	);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if(!$id)
        {
            return $this->redirect()->toRoute('medicaments');
        }
        $medicament = $this->getMedicamentsTable()->getMedicament($id);

        $form  = new MedicamentForm();
        // The method bind() attaches the model to the form
        $form->bind($medicament);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getMedicamentsTable()->saveMedicament($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('medicaments');
            }
        }

        return array(
            'id'   => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        /*
         * TODO
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect()->toRoute('medicaments');
        }

        $request = $this->getRequest();
        if($request->isPost())
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id)
        );
        */
    }

    public function getMedicamentsTable()
    {
        if (!$this->medicamentsTable) {
            $serviceManager = $this->getServiceLocator();
            $this->medicamentsTable = $serviceManager->get('Medicaments\Model\MedicamentsTable');
        }
        return $this->medicamentsTable;
    }
}

