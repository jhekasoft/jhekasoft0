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
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/software',
                    'defaults' => array(
                        'controller' => 'Software\Controller\Software',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/type/:type][/platform/:platform][/author/:author][/page/:page]',
                            'constraints' => array(
                                'type'       => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'platform'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'author'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page'       => '[0-9]+',
                            ),
                            'defaults' => array(
                                'page'       => 1,
                            ),
                        ),
                    ),
                    'show' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/show[/:name]',
                            'constraints' => array(
                                'name'       => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action'     => 'show',
                            ),
                        ),
                    ),
                    'filter' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/filter',
                            'defaults' => array(
                                'action'   => 'filter',
                            ),
                        ),
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
