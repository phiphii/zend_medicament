<?php
$aConfig = array(
				'dev' => array(
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
				),
				'recette' => array(
					'webhost' => 'localhost',
					'database' => array(
						'adapter' => 'pdo_mysql',
						'params' => array(
							'host' => 'localhost',
							'dbname' => 'projet_zend_recette',
							'user' => 'root',
							'password' => 'root',
					 	)
					)
				),
				'production' => array(
					'webhost' => 'localhost',
					'database' => array(
						'adapter' => 'pdo_mysql',
						'params' => array(
							'host' => 'localhost',
							'dbname' => 'projet_zend',
							'user' => 'root',
							'password' => 'root',
					 	)
					)
				),
			);

return $aConfig;