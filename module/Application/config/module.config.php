<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
        	// Página inicial
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Hostname',
                'options' => array(
                    'route'    => 'ameriauto.localhost.br',
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Application\Controller',
                    ),
				),
                'may_terminate' => true,
                'child_routes' => array(
                	'default' => array(
                		'type' => 'Literal',
                		'options' => array(
                			'route' => '/',
                			'defaults' => array(
								'__NAMESPACE__' => 'Application\Controller',
                    			'controller' 	=> 'Index',
                    			'action'     	=> 'index',
                			),
                		),
                	),
                ),
            ),
            // Login
            'login' => array(
                'type'    => 'Zend\Mvc\Router\Http\Hostname',
                'options' => array(
                    'route'    => 'login.ameriauto.localhost.br',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                
                    'default' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/',
                            'constraints' => array(
                            ),
                            'defaults' => array(
								'__NAMESPACE__' => 'Usuario\Controller',
                        		'controller'    => 'Login',
                        		'action'        => 'index',
                            ),
                        ),
                    ),
                    // Login - Anúncios
                    'anuncios' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/anuncios',
                    		'defaults' => array(
								'__NAMESPACE__' => 'Anuncio\Controller',
                        		'controller'    => 'BackendAnuncio',
                        		'action'        => 'listar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
                    					'__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendAnuncio',
                    					'action'		=> 'inserir',
                    				),
                    			),
                    		),
                    		'action' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => '(editar|apagar)',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    					'__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendAnuncio',
                    				),
                    			),
                    		),
                    		'ajax' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/ajax',
                    			),
                    			'may_terminate' => false,
                    			'child_routes' => array(
                    				'ajax-fabricante-options' => array(
                    					'type' => 'Zend\Mvc\Router\Http\Literal',
                    					'options' => array(
                    						'route' => '/selectfabricante',
                    						'defaults' => array(
                    						'__NAMESPACE__' => 'Anuncio\Controller',
                    						'controller' 	=> 'BackendAnuncio',
                    						'action'		=> 'ajaxFabricanteOptions',
                    						),
                    					),
                    				),
                    				'ajax-veiculo-options' => array(
                    					'type' => 'Zend\Mvc\Router\Http\Literal',
                    					'options' => array(
                    						'route' => '/selectveiculo',
                    						'defaults' => array(
                    						'__NAMESPACE__' => 'Anuncio\Controller',
                    						'controller' 	=> 'BackendAnuncio',
                    						'action'		=> 'ajaxVeiculoOptions',
                    						),
                    					),
                    				),
                    			),
                    		),
                    	),
                    ),
                    // Login - Dados de usuários
                    'usuarios-concessionarias' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/usuarios-concessionarias',
                    		'defaults' => array(
                    		),
                    	),
                    ),
                    'usuarios-particulares' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/usuarios-particulares',
                    		'defaults' => array(
                    		),
                    	),
                    ),
                    'conta' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/conta',
                    		'defaults' => array(
                    		),
                    	),
                    ),
                    // Login - Banners
                    'banners' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/banners',
                    		'defaults' => array(
            				    '__NAMESPACE__' => 'Anuncio\Controller',
            					'controller'	=> 'BackendBanner',
            					'action'		=> 'bannerListarInserir',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'editar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    // Login - Tipos de Banners
                    'banners-tipos' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/banners-tipos',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendBanner',
	        					'action'		=> 'bannerTipoInserir',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerTipoInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'editar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerTipoEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Anuncio\Controller',
                    					'controller'	=> 'BackendBanner',
                    					'action'		=> 'bannerTipoApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    // Login - Localidades
                    'cidades' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/cidades',
                    		'defaults' => array(
            				    '__NAMESPACE__' => 'Usuario\Controller',
            					'controller'	=> 'BackendLocalidade',
            					'action'		=> 'cidadeListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'cidadeInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'editar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'cidadeEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'cidadeApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    'estados' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/estados',
                    		'defaults' => array(
            				    '__NAMESPACE__' => 'Usuario\Controller',
            					'controller'	=> 'BackendLocalidade',
            					'action'		=> 'estadoListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
		            				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'estadoInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'editar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
		            				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'estadoEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
		            				    '__NAMESPACE__' => 'Usuario\Controller',
		            					'controller'	=> 'BackendLocalidade',
		            					'action'		=> 'estadoApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    'regioes' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/regioes',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Usuario\Controller',
	        					'controller'	=> 'BackendLocalidade',
	        					'action'		=> 'regiaoListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Usuario\Controller',
			        					'controller'	=> 'BackendLocalidade',
			        					'action'		=> 'regiaoInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'editar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Usuario\Controller',
			        					'controller'	=> 'BackendLocalidade',
			        					'action'		=> 'regiaoEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Usuario\Controller',
			        					'controller'	=> 'BackendLocalidade',
			        					'action'		=> 'regiaoApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    // Login - Veículos
                    'veiculos' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendVeiculo',
	        					'action'		=> 'veiculoListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    'veiculos-tipos' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos-tipos',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendVeiculo',
	        					'action'		=> 'veiculoTipoListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoApagar',
                    				),
                    			),
                    		),
                    	),
                    ),
                    'veiculos-combustiveis' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos-combustiveis',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendVeiculo',
	        					'action'		=> 'veiculoCombustivelListar',
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCombustivelInserir',
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCombustivelEditar',
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'action' => 'apagar',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCombustivelApagar',                    				
                    				),
                    			),
                    		),
                    	),
                    ), 
                    'veiculos-cores' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos-cores',
                    		'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCorListar', 
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCorInserir', 
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCorEditar', 
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoCorApagar', 
                    				),
                    			),
                    		),
                    	),
                    ), 
                    'veiculos-fabricantes' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos-fabricantes',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendVeiculo',
	        					'action'		=> 'veiculoFabricanteListar', 
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoFabricanteInserir', 
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoFabricanteEditar', 
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoFabricanteApagar', 
                    				),
                    			),
                    		),
                    	),
                    ),
                    'veiculos-tipos-fabricantes' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/veiculos-tipos-fabricantes',
                    		'defaults' => array(
	        				    '__NAMESPACE__' => 'Anuncio\Controller',
	        					'controller'	=> 'BackendVeiculo',
	        					'action'		=> 'veiculoTipoFabricanteListar', 
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoFabricanteInserir', 
                    				),
                    			),
                    		),
                    		'editar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/editar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoFabricanteEditar', 
                    				),
                    			),
                    		),
                    		'apagar' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/apagar/:id',
                    				'constraints' => array(
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
			        				    '__NAMESPACE__' => 'Anuncio\Controller',
			        					'controller'	=> 'BackendVeiculo',
			        					'action'		=> 'veiculoTipoFabricanteApagar', 
                    				),
                    			),
                    		),
                    	),
                    ),
                    // Login - Websites
                    'websites' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/websites',
                    		'defaults' => array(
                    		),
                    	),
                    ),  
                    'website-config' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/website-config',
                    		'defaults' => array(
                    		),
                    	),
                    ),
                    'website-paginas' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/website-paginas',
                    		'defaults' => array(
                    		),
                    	),
                    	'may_terminate' => true,
                    	'child_routes' => array(
                    		'inserir' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Literal',
                    			'options' => array(
                    				'route' => '/inserir',
                    				'defaults' => array(
                    				),
                    			),
                    		),
                    		'action' => array(
                    			'type' => 'Zend\Mvc\Router\Http\Segment',
                    			'options' => array(
                    				'route' => '/:action/:id',
                    				'constraints' => array(
                    					'action' => '(editar|apagar)',
                    					'id' => '[0-9]*',
                    				),
                    				'defaults' => array(
                    				),
                    			),
                    		),
                    	),
                    ), 
                    // Login - Logs
                    'logs' => array(
                    	'type' => 'Zend\Mvc\Router\Http\Literal',
                    	'options' => array(
                    		'route' => '/logs',
                    		'defaults' => array(
                    		),
                    	),
                    ),                                       
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'invokables' => array(
        	'file-manager' => 'Application\Service\Invokable\FileManager',
        	'table-gateway' => 'Application\Service\Invokable\TableGateway',
        ),
        'factories' => array(
        	'database' => 'Application\Service\Factory\DatabaseFactory',
        ),
        'initializers' => array(
        	'Application\Service\Initializer\UploadDirectoryStructure',
        )
    ),
    'upload_directory_structure' => array(
    	'upload_base' => 'upload', // for showing files only, /public directory is not necessary
    	'upload_root' => './public/upload', // public directory necessary for moving files
    	'anuncio' => array(
			'main-directory' => 'anuncio',
    		'backend-thumbnail' => 'backend_thumb'
    	),
    	'banner' => array(
    		'main-directory' => 'banner',
    	)
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
