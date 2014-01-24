<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Medicaments\Form\ConfigurationForm;

class ConfigurationController extends AbstractActionController
{
	// var configurationTable needed in order to use database
	protected $configurationTable;


    /*
     * OLD FUNCTIONS (Used with select instead of table)
     */
    /*
    public function indexAction()
    {
        $form = new ConfigurationForm();
        $form->get('submit')->setValue('Ok');
        return new ViewModel(
                        array(
                            'form' => $form,
                            'configurations' => $this->getConfigurationTable()->fetchAll()
                        ));
    }

    public function changeConfigurationAction()
    {
    	$form = new ConfigurationForm();
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Setting the file selected into session
                $session              = new Container('configuration');
                $session->config_file = $request->getPost()->config_file;
                $session->environment = $request->getPost()->environment;
                // Redirect to index action
                return $this->redirect()->toRoute('medicaments');
            }
        }
        return array('session' => $session, 'form' => $form);
    }
    */

    public function indexAction()
    {
        return new ViewModel(
                        array(
                            'configurations' => $this->getConfigurationTable()->fetchAll()
                        ));
    }

    public function changeConfigurationAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $id = (int)$request->getPost('id');
            if (!$id)
            {
                return $this->redirect()->toRoute('configuration');
            }

            $session              = new Container('configuration');
            $session->config_file = $request->getPost()->config_file;
            $session->environment = $request->getPost()->environment;

            // Redirect to list of drugs
            return $this->redirect()->toRoute('medicaments');
        }

        return array(
            'id'    => $id,
        );
    }

    public function getConfigurationTable()
    {
        if (!$this->configurationTable) {
            $serviceManager = $this->getServiceLocator();
            $this->configurationTable = $serviceManager->get('Medicaments\Model\ConfigurationTable');
        }
        return $this->configurationTable;
    }


}

