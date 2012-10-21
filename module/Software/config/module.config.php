<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Software\Controller\Software' => 'Software\Controller\SoftwareController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'software' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/software[/:action][/:name]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'name'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                        //'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Software\Controller\Software',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'software' => __DIR__ . '/../view',
        ),
    ),
);
