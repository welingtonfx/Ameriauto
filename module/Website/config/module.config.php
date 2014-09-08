<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Website\Controller\BackendWebsite' => 'Website\Controller\BackendWebsiteController',
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
    'view_manager' => array(
        'template_path_stack' => array(
            'Website' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
    	'invokables' => array(
    		'website-cfg-entity' => 'Website\Model\Entity\WebsiteCfgEntity',
    		'website-pagina-entity' => 'Website\Model\Entity\WebsitePaginaEntity',
    		
    		'website-cfg-table' => 'Website\Model\Table\WebsiteCfgTable',
    		'website-pagina-table' => 'Website\Model\Table\WebsitePaginaTable',
    		
    		'website-cfg-form' => 'Website\Model\Form\WebsiteCfgForm',
    		'website-pagina-form' => 'Website\Model\Form\WebsitePaginaForm',    		
    	),
    ),
);
