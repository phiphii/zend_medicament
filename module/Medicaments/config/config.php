<?php
$aConfig = array(
				'webhost' => 'localhost',
				'database' => array(
					'adapter' => 'pdo_mysql',
					'params' => array(
						'host' => 'localhost',
						'dbname' => 'projet_zend_dev',
						'user' => 'root',
						'password' => 'root',
				 	)
				)
			);

return $aConfig;