<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Blog' => 'Blog\Controller\BlogController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/blog',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Blog',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/page/:page]',
                            'constraints' => array(
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
                    'rss' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/rss',
                            'defaults' => array(
                                'action'  => 'rss',
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
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewFeedStrategy',
        ),
    ),
);
