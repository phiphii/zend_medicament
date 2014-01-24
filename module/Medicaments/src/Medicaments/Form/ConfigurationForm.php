<?php
namespace Medicaments\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ConfigurationForm extends Form
{
    public function __construct($name = null)
    {
        // Création du formulaire portant le name "configuration-form"
        parent::__construct('configuration-form');
        // Définition du type de formulaire
        $this->setAttribute('method', 'post');

        // Ajout de la liste déroulante et du bouton d'envoi
        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'config_file',
             'options' => array(
                          'value_options' => array(
                                                 'php' => 'php',
                                                 'ini' => 'ini',
                                                 'xml' => 'xml',
                                                 'yaml' => 'yaml',
                                                 'json' => 'json',
                                             ),
             )
        ));
        $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'environment',
                'options' => array(
                                'value_options' => array(
                                    'dev' => 'dev',
                                    'recette' => 'recette',
                                    'production' => 'production',
                                ),
                )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'label' => 'Ok',
                'id' => 'submitbutton',
            ),
        ));
    }
}