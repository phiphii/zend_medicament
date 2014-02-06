<?php
namespace Medicaments\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\I18n\Translator\Translator;

class ContactForm extends Form
{
    public function __construct($name = null)
    {
        // Création du formulaire portant le name "configuration-form"
        parent::__construct('contact-form');
        $this->setAttribute('method', 'post');

        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'fr_FR';
        $translator = new Translator();

        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => $translator->translate('Name', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'lastName',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => $translator->translate('Last name', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => $translator->translate('E-mail', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'tel',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => $translator->translate('Phone', 'default', $lang),
            ),
        ));
        $this->add(array(
            'name' => 'message',
            'attributes' => array(
                'type'  => 'textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => $translator->translate('Message', 'default', $lang),
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => $translator->translate('captcha', 'default', $lang),
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => new Captcha\Dumb(),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'label' => 'Ok',
                'class' => 'btn btn-primary',
                'id' => 'submitbutton',
            ),
        ));
    }
}