<?php
return array(
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'router' => array(
        'routes' => array(
            'module-name-here' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/module-specific-root',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'ZendSkeletonModule\Controller',
                        'controller'    => 'Skeleton',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
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
        ),
    ),
    'service_manager' => array(
    	'invokables' => array(
    		'image-resizer' => 'Imagem\Service\Invokable\ImageResizer',
    		'image-fixed-resizing' => 'Imagem\Service\Invokable\ImageFixedResizing',
    		'image-proportional-resizing' => 'Imagem\Service\Invokable\ImageProportionalResizing',
    		'image-square-crop-resizing' => 'Imagem\Service\Invokable\ImageSquareCropResizing',
    	),
    	'shared' => array(
    		//'image-resizer' => false,
    		//'image-fixed-resizing' => false,
    		//'image-proportional-resizing' => false,
    		//'image-square-crop-resizing' => false,
    	),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Imagem' => __DIR__ . '/../view',
        ),
    ),
);
