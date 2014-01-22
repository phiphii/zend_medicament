<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Medicaments\Form\ConfigurationForm;

class IndexController extends AbstractActionController
{
	protected $medicamentsTable;

    public function indexAction()
    {
    	$form = new ConfigurationForm();
        $form->get('submit')->setValue('Ok');
        // Initialize Zend\Session container in order to send it to our view
        $session = new Container('configuration');
        return new ViewModel(
		        		array(
		        			'form' => $form,
		        			'session' => $session,
		        			'medicaments' => $this->getMedicamentsTable()->fetchAll(),
	        			)
		        	);
    }

    public function changeConfigurationAction()
    {
    	$form = new ConfigurationForm();
        $form->get('submit')->setValue('Ok');

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid())
            {
            	// Setting the file selected into session
				$session              = new Container('configuration');
				$session->file        = $request->getPost()->filetype;
				$session->environment = $request->getPost()->environment;
                // Redirect to index action
                return $this->redirect()->toRoute('medicaments');
            }
        }
        return array('session' => $session, 'form' => $form);
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

