<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Sound\Controller\Sound' => 'Sound\Controller\SoundController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'sound' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/sounds',
                    'defaults' => array(
                        'controller' => 'Sound\Controller\Sound',
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
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'sound' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'sound_block' => 'Sound\View\Helper\SoundBlock',
        )
    ),
);
