<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Medicaments\Model\Medicaments;
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

    public function addAction()
    {
        $form    = new MedicamentForm();
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $medicament = new Medicaments();
            $form->setInputFilter($medicament->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $medicament->exchangeArray($form->getData());
                $this->getMedicamentsTable()->saveMedicament($medicament);

                // Redirect to list of drugs
                return $this->redirect()->toRoute('medicaments');
            }
        }
        return array('form' => $form);
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
            $form->setInputFilter($medicament->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getMedicamentsTable()->saveMedicament($form->getData());

                // Redirect to list of drugs
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
                $this->getMedicamentsTable()->deleteMedicament($id);
            }

            // Redirect to list of drugs
            return $this->redirect()->toRoute('medicaments');
        }

        return array(
            'id'    => $id,
            'medicament' => $this->getMedicamentsTable()->getMedicament($id)
        );
    }

    public function getMedicamentsTable()
    {
        if (!$this->medicamentsTable) {
            $serviceManager = $this->getServiceLocator();
            $this->medicamentsTable = $serviceManager->get('Medicaments\Model\MedicamentsTable');
        }
        return $this->medicamentsTable;
    }

    /*
     * OLD METHOD: used to get the controller and action's name in order to use them in the layout.
     * Useless since using the onBootstrap method (in Module.php)
     */
    /*
    public function getDispatcher()
    {
        $request                  = $this->params()->fromRoute();
        $dispatcher               = array();
        $dispatcher['controller'] = $request['controller'];
        $dispatcher['action']     = $request['action'];
        $dispatcher['view']       = $request['action'];
        return $dispatcher;
    }
    */
}

