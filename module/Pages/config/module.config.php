<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Pages\Controller\Pages' => 'Pages\Controller\PagesController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'pages' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/pages',
                    'defaults' => array(
                        'controller' => 'Pages\Controller\Pages',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/parent/:parent][/page/:page]',
                            'constraints' => array(
                                'parent'       => '[a-zA-Z][a-zA-Z0-9_-]*',
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
                                'name'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action'  => 'show',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/edit[/:name]',
                            'constraints' => array(
                                'name'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action'  => 'edit',
                            ),
                        ),
                    ),
                    'add' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'action'  => 'add',
                            ),
                        ),
                    ),
//                    'filter' => array(
//                        'type'    => 'Literal',
//                        'options' => array(
//                            'route'    => '/filter',
//                            'defaults' => array(
//                                'action'   => 'filter',
//                            ),
//                        ),
//                    ),
                ),
            ),
            'video' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/video',
                    'defaults' => array(
                        'controller' => 'Pages\Controller\Pages',
                        'action'     => 'show',
                        'name' => 'video'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'instead' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/instead',
                            'defaults' => array(
                                'name' => 'video-instead',
                            ),
                        ),
                    ),
                ),
            ),
            'sound' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/sound',
                    'defaults' => array(
                        'controller' => 'Pages\Controller\Pages',
                        'action'     => 'show',
                        'name' => 'sound'
                    ),
                ),
            ),
//            'blog' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    'route'    => '/blog',
//                    'defaults' => array(
//                        'controller' => 'Pages\Controller\Pages',
//                        'action'     => 'show',
//                        'name' => 'blog'
//                    ),
//                ),
//            ),
            'about' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/about',
                    'defaults' => array(
                        'controller' => 'Pages\Controller\Pages',
                        'action'     => 'show',
                        'name' => 'about'
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'pages' => __DIR__ . '/../view',
        ),
    ),
);
