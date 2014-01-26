<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Header\SetCookie;
use Zend\Http\Client;

class LanguageController extends AbstractActionController
{

    public function indexAction()
    {
    	$langId = (int)$this->params()->fromRoute('id', 0);
    	switch ($langId)
    	{
    		case 1:
    			$lang = 'fr_FR';
    			break;
    		case 2:
    			$lang = 'en_US';
    			break;
    		case 3:
    			$lang = 'es_ES';
    			break;
    		default:
    			$lang = 'fr_FR';
    			break;
    	}
    	setcookie('lang', $lang, time()+60*60*24*120, '/');
        $redirectUrl = $this->getRequest()->getHeader('Referer')->getUri();
        return $this->redirect()->toUrl($redirectUrl);
    }
}

