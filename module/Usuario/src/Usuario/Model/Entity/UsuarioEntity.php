<?php
namespace Anuncio\Model\Entity;

class UsuarioEntity
{
	/**
	 * @var int
	 */
	protected $idUsuario;
	
	/**
	 * @var string
	 */
	protected $email;
	
	/**
	 * @var string
	 */
	protected $senha;
	
	/**
	 * @var int
	 */
	protected $idRole;
	
	/**
	 * @var int $idUsuario
	 * return UsuarioEntity
	 */
	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	
	/**
	 * @var string $email
	 * return UsuarioEntity
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */	
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @var string $senha
	 * return UsuarioEntity
	 */	
	public function setSenha($senha)
	{
		$this->senha = $senha;
		return $this;
	}
	
	/**
	 * @return string
	 */		
	public function getSenha()
	{
		return $this->senha;
	}
	
	/**
	 * @var int $idRole
	 * return UsuarioEntity
	 */
	public function setIdRole($idRole)
	{
		$this->idRole = $idRole;
		return $this;
	}

	/**
	 * @return int
	 */	
	public function getIdRole()
	{
		return $this->idRole;
	}
}