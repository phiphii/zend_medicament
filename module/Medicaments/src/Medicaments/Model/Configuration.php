<?php
namespace Medicaments\Model;

class Configuration
{
    public $id;
    public $config_file;
    public $environment;

    public function exchangeArray($data)
    {
		$this->id   = (isset($data['id'])) ? $data['id'] : null;
		$this->name = (isset($data['config_file'])) ? $data['config_file'] : null;
		$this->name = (isset($data['environment'])) ? $data['environment'] : null;		
    }
}