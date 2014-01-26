<?php
namespace Medicaments\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;

class ContactForm extends Form
{
    public function __construct($name = null)
    {
        // Création du formulaire portant le name "configuration-form"
        parent::__construct('contact-form');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));
        $this->add(array(
            'name' => 'lastName',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Last name',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));
        $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'tel',
                'pattern'  => '^0[1-68]([-. ]?[0-9]{2}){4}$'
            ),
            'options' => array(
                'label' => 'Phone',
            ),
        ));
        $this->add(array(
            'name' => 'message',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => 'Message',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
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
                'id' => 'submitbutton',
            ),
        ));
    }
}