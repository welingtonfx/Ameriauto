<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Usuario\Controller\Login' 				=> 'Usuario\Controller\LoginController',
            'Usuario\Controller\BackendLocalidade' 	=> 'Usuario\Controller\BackendLocalidadeController',
            'Usuario\Controller\BackendUsuario'		=> 'Usuario\Controller\BackendUsuarioController',                   
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
            'Usuario' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
    	'invokables' => array(
    		'cidade-entity' => 'Usuario\Model\Entity\CidadeEntity',
    		'estado-entity' => 'Usuario\Model\Entity\EstadoEntity',
    		'regiao-entity' => 'Usuario\Model\Entity\RegiaoEntity',
    		'usuario-entity' => 'Usuario\Model\Entity\UsuarioEntity',
    		'usuario-concessionaria-entity' => 'Usuario\Model\Entity\UsuarioConcessionariaEntity',
    		'usuario-particular-entity' => 'Usuario\Model\Entity\UsuarioParticularEntity', 
    	
    		'cidade-table' => 'Usuario\Model\Table\CidadeTable',
    		'estado-table' => 'Usuario\Model\Table\EstadoTable',
    		'regiao-table' => 'Usuario\Model\Table\RegiaoTable',
    		'usuario-table' => 'Usuario\Model\Table\UsuarioTable',
    		'usuario-concessionaria-table' => 'Usuario\Model\Table\UsuarioConcessionariaTable',
    		'usuario-particular-table' => 'Usuario\Model\Table\UsuarioParticularTable',
    		
			'cidade-form' => 'Usuario\Form\CidadeForm',
			'estado-form' => 'Usuario\Form\EstadoForm',
			'regiao-form' => 'Usuario\Form\RegiaoForm',		
    	),
    ),
);
