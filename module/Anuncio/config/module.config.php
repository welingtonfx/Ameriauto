<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Anuncio\Controller\BackendAnuncio' => 'Anuncio\Controller\BackendAnuncioController',
            'Anuncio\Controller\BackendBanner' 	=> 'Anuncio\Controller\BackendBannerController',
            'Anuncio\Controller\BackendEmail' 	=> 'Anuncio\Controller\BackendEmailController',
            'Anuncio\Controller\BackendVeiculo' => 'Anuncio\Controller\BackendVeiculoController',
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
            'Anuncio' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
    	'invokables' => array(
    		'anuncio-entity' => 'Anuncio\Model\Entity\AnuncioEntity',
    		'banner-entity' => 'Anuncio\Model\Entity\BannerEntity',
    		'banner-tipo-entity' => 'Anuncio\Model\Entity\BannerTipoEntity',
    		'email-entity' => 'Anuncio\Model\Entity\EmailEntity',
    		'veiculo-combustivel-entity' => 'Anuncio\Model\Entity\VeiculoCombustivelEntity',
    		'veiculo-cor-entity' => 'Anuncio\Model\Entity\VeiculoCorEntity',
    		'veiculo-tipo-entity' => 'Anuncio\Model\Entity\VeiculoTipoEntity',
     		'veiculo-fabricante-entity' => 'Anuncio\Model\Entity\VeiculoFabricanteEntity',
    		'veiculo-tipo-fabricante-entity' => 'Anuncio\Model\Entity\VeiculoTipoFabricanteEntity',
    		'veiculo-entity' => 'Anuncio\Model\Entity\VeiculoEntity',  		
    		
    		'anuncio-model' => 'Anuncio\Model\AnuncioModel',
    		'banner-model' => 'Anuncio\Model\BannerModel',

    		'anuncio-table' => 'Anuncio\Model\Table\AnuncioTable',    		
    		'banner-table' => 'Anuncio\Model\Table\BannerTable',
    		'banner-tipo-table' => 'Anuncio\Model\Table\BannerTipoTable',
    		'email-table' => 'Anuncio\Model\Table\EmailTable',
    		'veiculo-combustivel-table' => 'Anuncio\Model\Table\VeiculoCombustivelTable',
    		'veiculo-cor-table' => 'Anuncio\Model\Table\VeiculoCorTable',
    		'veiculo-tipo-table' => 'Anuncio\Model\Table\VeiculoTipoTable',
    		'veiculo-fabricante-table' => 'Anuncio\Model\Table\VeiculoFabricanteTable',
    		'veiculo-tipo-fabricante-table' => 'Anuncio\Model\Table\VeiculoTipoFabricanteTable',
    		'veiculo-table' => 'Anuncio\Model\Table\VeiculoTable',
    		
    		'anuncio-form' => 'Anuncio\Form\AnuncioForm',
    		'banner-form' => 'Anuncio\Form\BannerForm',
    		'banner-tipo-form' => 'Anuncio\Form\BannerTipoForm',
    		'email-form' => 'Anuncio\Form\EmailForm',
    		'veiculo-combustivel-form' => 'Anuncio\Form\VeiculoCombustivelForm',
    		'veiculo-cor-form' => 'Anuncio\Form\VeiculoCorForm',
    		'veiculo-fabricante-form' => 'Anuncio\Form\VeiculoFabricanteForm',
    		'veiculo-form' => 'Anuncio\Form\VeiculoForm',
    		'veiculo-tipo-fabricante-form' => 'Anuncio\Form\VeiculoTipoFabricanteForm',
    		'veiculo-tipo-form' => 'Anuncio\Form\VeiculoTipoForm',
    	),
    	'shared' => array(
    		'anuncio-entity' => false,
    	)
    ),
    'form_elements' => array(
    	'invokables' => array(),
    ),
);
