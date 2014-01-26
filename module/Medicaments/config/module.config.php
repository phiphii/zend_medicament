<?php
if(isset($_COOKIE['lang']))
{
    $lang = $_COOKIE['lang'];
}
else
{
    $lang = 'fr_FR';
}
return array(
    'router' => array(
        'routes' => array(
            'medicaments' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/medicaments[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Medicaments\Controller',
                        'controller' => 'Medicaments\Controller\Index',
                        'action'     => 'index',
                    ),
                 ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'configuration' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/medicaments/configuration[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Medicaments\Controller\Configuration',
                        'action'     => 'index',
                    ),
                ),
            ),
            'contact' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/medicaments/contact[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Medicaments\Controller\Contact',
                        'action'     => 'index',
                    ),
                ),
            ),
            'language' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/medicaments/language[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Medicaments\Controller\Language',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => $lang,
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
     'controllers' => array(
         'invokables' => array(
             'Medicaments\Controller\Index' => 'Medicaments\Controller\IndexController',
             'Medicaments\Controller\Configuration' => 'Medicaments\Controller\ConfigurationController',
             'Medicaments\Controller\Contact' => 'Medicaments\Controller\ContactController',
             'Medicaments\Controller\Language' => 'Medicaments\Controller\LanguageController',
         ),
     ),
     'view_manager' => array(
         'display_not_found_reason' => true,
         'display_exceptions'       => true,
         'doctype'                  => 'HTML5',
         'not_found_template'       => 'error/404',
         'exception_template'       => 'error/index',
         'template_map' => array(
             'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
             'error/404'               => __DIR__ . '/../view/error/404.phtml',
             'error/index'             => __DIR__ . '/../view/error/index.phtml',
         ),
         'template_path_stack' => array(
             __DIR__ . '/../view',
         ),
         'strategies' => array(
            'ViewFeedStrategy',),
     ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
?>