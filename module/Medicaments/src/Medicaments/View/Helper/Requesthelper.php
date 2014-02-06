<?php
namespace Medicaments\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RequestHelper extends AbstractHelper
{

	protected  $request;

	public function getRequest(){ return $this->request; }

	public function setRequest($request) {

		$this->request = $request;
	}

	public function __invoke() {

		return $this->getRequest()->getServer()->get('QUERY_STRING');
	}


}

?>