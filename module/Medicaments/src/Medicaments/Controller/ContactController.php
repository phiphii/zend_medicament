<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Medicaments\Form\ContactForm;
use Medicaments\Model\Contact;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;

class ContactController extends AbstractActionController
{

    public function indexAction()
    {
        $dispatcher = $this->getDispatcher();
        $this->layout()->dispatcher = $dispatcher;
    	$form    = new ContactForm();
        $form->get('submit')->setValue('Send'); 
        
    	return new ViewModel(array('form' => $form));	
    }

    public function sendAction()
    {
        $dispatcher = $this->getDispatcher();
        $this->layout()->dispatcher = $dispatcher;
    	$form    = new ContactForm();
        $form->get('submit')->setValue('Send');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $contact = new Contact();
            $form->setInputFilter($contact->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
            	try{
            		$message = new Message();
            		$message->addFrom($request->getPost('email'), $request->getPost('firstname') . $request->getPost('lastName'))
					        ->addTo('axel.bouaziz@hotmail.fr')
					        ->setSubject('Someone wants to contact you (project Zend)');
					$message->setBody(
						$request->getPost('firstname') . $request->getPost('lastName') . 
						' sent you a message from the ZF application.
						
						Phone number: ' . $request->getPost('phone') .
						'

						Message: ' . $request->getPost('message')
					);
					$message->addReplyTo($request->getPost('email'), $request->getPost('firstname'));
					$message->setEncoding("UTF-8");

					$transport = new SendmailTransport();
					$transport->send($message);

					return $this->redirect()->toRoute('medicaments');
				}catch(Exception $e){
					return $this->redirect()->toRoute('contact');
				}
            }else
            {
            	return $this->redirect()->toRoute('contact');
            }
        }
        return array('form' => $form);
    }

    public function getDispatcher()
    {
        $request                  = $this->params()->fromRoute();
        $dispatcher               = array();
        $dispatcher['controller'] = $request['controller'];
        $dispatcher['action']     = $request['action'];
        $dispatcher['view']       = $request['action'];
        return $dispatcher;
    }

}

