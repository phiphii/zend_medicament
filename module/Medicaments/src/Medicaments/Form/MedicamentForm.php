<?php
namespace Medicaments\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\I18n\Translator\Translator;

class MedicamentForm extends Form
{
    public function __construct($name = null)
    {
        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'fr_FR';
        $translator = new Translator();
        // Création du formulaire portant le name "edit-medicament-form"
        parent::__construct('edit-medicament-form');
        // Définition du type de formulaire
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => $translator->translate('Name', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'molecule',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => $translator->translate('Molecule', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'indications',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => $translator->translate('Indications', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'cons_indications',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => $translator->translate('Cons-indications', 'default', $lang),
            ),
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