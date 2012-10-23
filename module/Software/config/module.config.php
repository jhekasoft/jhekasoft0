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
                    'route'    => '/software[/:action][/:name][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'name'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page'     => '[0-9]+',
                        //'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Software\Controller\Software',
                        'action'     => 'index',
                        'page'       => 1,
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
    'view_helpers' => array(
        'invokables'=> array(
            'side_left_software' => 'Software\View\Helper\SideLeftSoftware',
        )
    ),
);
