<?php

namespace Medicaments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;

class RssController extends AbstractActionController
{
	protected $medicamentsTable;

    public function indexAction()
    {
		$feed = new Feed();
		$feed->setTitle('Médicaments');
		$feed->setLink('http://localhost/Projet_Zend/public/medicaments');
		$feed->setDescription('RSS Feed for drugs');
		$feed->setFeedLink('http://localhost/Projet_Zend/public/medicaments/rss', 'rss');
		$feed->setDateModified(time());

		foreach ($this->getMedicamentsTable()->fetchAll() as $medicament)
		{
			$entry = $feed->createEntry();
			$entry->setTitle($medicament->name);
			$entry->addAuthor(array(
			    'name'  => 'Axel',
			    'email' => 'axel.bouaziz@hotmail.fr',
			    'uri'   => 'http://localhost/Projet_Zend',
			));
			$entry->setDateModified(time());
			$entry->setDateCreated(time());
			$entry->setDescription('Medicament ID ' . $medicament->id);
			$entry->setContent(
			    'Medicament ID ' . $medicament->id . ' - Name: ' . $medicament->name
			);
			$feed->addEntry($entry);
		}

		$feed->export('rss');
		$feedmodel = new FeedModel();
        $feedmodel->setFeed($feed);
 
        return $feedmodel;
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

