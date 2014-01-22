<?php
namespace Medicaments\Model;

class Medicaments
{
    public $id;
    public $name;

    public function exchangeArray($data)
    {
		$this->id   = (isset($data['id'])) ? $data['id'] : null;
		$this->name = (isset($data['name'])) ? $data['name'] : null;
    }
}