<?php
namespace Anuncio\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\UploadDirectoryStructureAwareInterface;
use Imagem\Service\Invokable\ImageResizer;
use Imagem\Service\Invokable\ImageProportionalResizing;
use Imagem\Service\Invokable\ImageFixedResizing;
use Imagem\Service\Invokable\ImageSquareCropResizing;


class AnuncioModel implements ServiceLocatorAwareInterface,
							  UploadDirectoryStructureAwareInterface
{
	/**
	 * Prefixo dos campos de Fotos
	 */
	CONST IMAGE_FIELD_PREFIX = "caminhoFoto";
	
	/**
	 * Prefixo dos checkboxes associados à deleção de fotos
	 */
	CONST DELETE_CHECKBOX_PREFIX = "deleteFoto";
	
	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * @var array Recebe o conjunto de dados de um anúncio
	 */
	public $data = array();
	
	/**
	 * @var array Recebe o conjunto de um anúncio já publicado
	 */
	public $currentFotos = array();
	
	/**
	 * @var string Nome único do diretório onde serão armazenadas as fotos de um anúncio (ex: a placa do carro)
	 */
	public $uniqueDirName;
	
	/**
	 * @var string Diretório base das fotos enviadas por upload
	 */
	protected $anuncioBaseDir;
	
	/**
	 * @var string Diretório das miniaturas das fotos enviadas por upload
	 */
	protected $anuncioBackendThumbDir;
	
	/**
	 * Define o conjunto de dados de um determinado anúncio
	 * 
	 * O conjunto de dados recebidos geralmente engloba todos os campos relacionados a um anúncio (como uma Entidade)
	 * Esses dados são usados para serem manipulados por outros métodos contidos neste Model
	 * 
	 * @var array $data 
	 */
	public function setData(array $data)
	{
		$this->data = $data;
		$this->uniqueDirName = $this->data['placa'];
	}
	
	/**
	 * Retorna o conjunto de dados do anúncio
	 */
	public function getData()
	{
		return $this->data;
	}
	
	/**
	 * Define a lista de fotos existentes antes da edição de um anúncio
	 * 
	 * Durante a edição de um anúncio, pode ser necessário apagar fotos anteriores, portanto a necessidade de passá-las ao Model
	 * 
	 * @todo Pensar em um método melhor de se obter as fotos. Dados do setData() são os dados já alterados com a edição do formulário. 
	 * 
	 * @var array $fotos
	 */
	public function setCurrentFotos($fotos)
	{
		$this->currentFotos = $fotos;
	}
	
	/**
	 * Retorna a lista fotos existentes antes da edição de um anúncio
	 */
	public function getCurrentFotos()
	{
		return $this->currentFotos;
	}
	
	/**
	 * Cria um diretório
	 * 
	 * @var string $directory
	 */
	public function createDirectory($directory)
	{
		if (is_dir($directory))
		{
			return false;
		}
		else
		{
			return mkdir($directory);
		}
	}
	
	/**
	 * Cria toda a estrutura de diretórios necessária para armazenas fotos relacionadas a um anúncio
	 */
	public function createDirectoryStructure()
	{
		$mainDirectory = $this->createDirectory(sprintf($this->anuncioBaseDir, $this->uniqueDirName));
		$backendThumbDirectory = $this->createDirectory(sprintf($this->anuncioBackendThumbDir, $this->uniqueDirName));
	}
	
	/**
	 * Redimensiona as imagens recebidas por upload
	 */
	public function resizeImages()
	{		
		$imageResizer = $this->serviceLocator->get('image-resizer');

		$pictureKeys = $this->getFotoFields();
				
		foreach($pictureKeys as $fieldKey => $picture)
		{
			if ("" !== $picture)
			{
				$extension = explode('.', $picture);
				$extension = $extension[count($extension)-1];
				$randomPosfix = substr(hash('sha512', uniqid(rand(), true)), rand(0, 96), rand(4, 32));
				
				$newPictureName = $this->uniqueDirName.'_'.$randomPosfix.'.'.$extension;
				$newFullSizeLocation = sprintf($this->anuncioBaseDir, $this->uniqueDirName).'/'.$newPictureName;
				$newBackendThumbLocation = sprintf($this->anuncioBackendThumbDir, $this->uniqueDirName).'/'.$newPictureName;
				
				// Resize Full Size
				$imageResizer->resize(
					array(
						 'format' => 'Proportional',
						 'image' => $picture,
						 'options' => array(
						 				   'base_size' => \Imagem\Service\Invokable\ImageProportionalResizing::WIDTH_AS_BASE,
						 				   'max_size' => 1130,
						 				   'save_path' => $newFullSizeLocation,
						 				   'quality' => 90,
						 				   'resize_smaller' => false,
						 				   ),
						 )
				);
				
				// Resize Thumbnails 
				$imageResizer->resize(
					array(
						 'format' => 'SquareCrop',
						 'image' => $newFullSizeLocation,
						 'options' => array(
						 				   'crop_size' => 85,
						 				   'save_path' => $newBackendThumbLocation,
						 				   'quality' => 75,
						 				   'resize_smaller' => false,
						 				   ),
						 )
				);
				
				unlink($picture);
				$this->data[$fieldKey] = $newPictureName;
			}
		}
	}
	
	/**
	 * Executa ações relacionadas à exclusão/alteração de fotos
	 */
	public function editFotos()
	{
		// Obtem os nomes dos campos de fotos (ex: caminhoFoto1, etc)
		$pictures = $this->getFotoFields();
		$pictureKeys = array_keys($pictures);

		foreach($pictureKeys as $key)
		{	
			$pictureNumber = substr($key, strlen(self::IMAGE_FIELD_PREFIX));

			$newUpload = ("" !== $this->data[$key]);
			$deleteImage = (true == ($this->data[self::DELETE_CHECKBOX_PREFIX . $pictureNumber]));
			
			// Se houver um novo upload, apaga as fotos que serão substituídas
			if($newUpload)
			{
				$this->deleteFotoInstances($this->currentFotos[$key]);				
			}
			
			// Apaga as fotos se solicitado remoção
			if(!$newUpload && $deleteImage)
			{
				$this->deleteFotoInstances($this->currentFotos[$key]);
				$this->data[$key] = '';
			}
			
			// Se não houve novo upload e nem remoção, remove o campo para que não seja atualizado
			if(!$newUpload && !$deleteImage)
			{
				unset($this->data[$key]);
			}
			
		}
	}
	
	/**
	 * Exclui todas as fotos e diretórios de um determinado anuncio 
	 */
	public function deleteFotos()
	{
		$fileManager = $this->serviceLocator->get('file-manager');
		
		$fileManager->deleteRecursively(sprintf($this->anuncioBaseDir, $this->uniqueDirName));
	}
	
	/**
	 * Remove todas as instâncias de uma foto (full size, miniaturas, etc)
	 * 
	 * @var string $pictureName
	 */
	public function deleteFotoInstances($pictureName)
	{
		unlink(sprintf($this->anuncioBaseDir, $this->uniqueDirName).'/'.$pictureName);
		unlink(sprintf($this->anuncioBackendThumbDir, $this->uniqueDirName).'/'.$pictureName);		
	}
	
	/**
	 * Isola e retorna somente os campos relacionados às fotos do Anúncio
	 * 
	 * @return array
	 */
	public function getFotoFields()
	{
		$caminhosFotos = array();
		
		foreach ($this->data as $key => $value)
		{	
			if(false !== strrpos($key, self::IMAGE_FIELD_PREFIX))
			{
				$this->data[$key] = is_array($this->data[$key]) ? $this->data[$key]['tmp_name'] : $this->data[$key];
				$caminhosFotos[$key] = $this->data[$key];
			}
		}
		
		return $caminhosFotos;
	}
	
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        $this->serviceLocator;
    }
 
     /* (non-PHPdoc)
     * @see \Application\Model\UploadDirectoryStructureAwareInterface::setUploadDirectoryStructure()
     */	   
	public function setUploadDirectoryStructure($uploadDirectoryConfig)
	{
		$uploadRoot = $uploadDirectoryConfig['upload_root'];
		$anuncioBase = $uploadDirectoryConfig['anuncio']['main-directory'];
		$backendThumbBase = $uploadDirectoryConfig['anuncio']['backend-thumbnail'];
		
		$this->anuncioBaseDir = $uploadRoot.'/'.$anuncioBase.'/%s';
		$this->anuncioBackendThumbDir = $this->anuncioBaseDir.'/'.$backendThumbBase;
	}

    /* (non-PHPdoc)
     * @see \Application\Model\UploadDirectoryStructureAwareInterface::getUploadDirectoryStructure()
     */	
	public function getUploadDirectoryStructure()
	{
		return $this->uploadDir;
	}
}