<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Api' => 'Api\Controller\ApiController',
            'Api\Controller\ApiAlbum' => 'Api\Controller\ApiAlbumController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'apialbum' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/apialbum[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\ApiAlbum',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
