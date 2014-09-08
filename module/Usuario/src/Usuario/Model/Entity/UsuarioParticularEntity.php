<?php
namespace Anuncio\Model\Entity;

class UsuarioParticularEntity
{	
	/**
	 * @var int
	 */
	protected $idUsuarioParticular;
	
	/**
	 * @var UsuarioEntity
	 */
	protected $idUsuario;
	
	/**
	 * @var int
	 */	
	protected $idCidade;

	/**
	 * @var string
	 */	
	protected $nome;
	
	/**
	 * @var string
	 */	
	protected $endereco;
	
	/**
	 * @var string
	 */	
	protected $bairro;
	
	/**
	 * @var string
	 */	
	protected $complemento;
	
	/**
	 * @var string
	 */	
	protected $cpf;
	
	/**
	 * @var int
	 */	
	protected $dddCelular;
	
	/**
	 * @var int
	 */	
	protected $celular;
	
	/**
	 * @var int
	 */	
	protected $dddTelefone;
	
	/**
	 * @var int
	 */	
	protected $telefone;
	
	/**
	 * @var DateTime
	 */	
	protected $dataCadastro;
	
	/**
	 * @var DateTime
	 */	
	protected $dataModificacao;
	
	/**
	 * @var bool
	 */	
	protected $emailConfirmado;
	
	/**
	 * @var string
	 */	
	protected $codConfirmacao;
	
	/**
	 * @var bool
	 */	
	protected $contaHabilitada;
	
	/**
	 * @var string
	 */	
	protected $codResetSenha;
	
	/**
	 * @var DateTime
	 */	
	protected $expResetSenha;
	
	/**
	 * @var int $idUsuarioParticular
	 * @return UsuarioParticularEntity
	 */
	public function setIdUsuarioParticular($idUsuarioParticular)
	{
		$this->idUsuarioParticular = $idUsuarioParticular;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getIdUsuarioParticular()
	{
		return $this->idUsuarioParticular;
	}
	
	/**
	 * @var UsuarioEntity $idUsuario
	 * @return UsuarioParticularEntity
	 */
	public function setIdUsuario(UsuarioEntity $idUsuario)
	{
		$this->idUsuario = $idUsuario;
		return $this;
	}
	
	/**
	 * @return UsuarioEntity
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	
	/**
	 * @var int $idCidade
	 * @return UsuarioParticularEntity
	 */
	public function setIdCidade($idCidade)
	{
		$this->idCidade = $idCidade;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getIdCidade()
	{
		return $this->idCidade;
	}
	
	/**
	 * @var string $nome
	 * @return UsuarioParticularEntity
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getNome()
	{
		return $this->nome;
	}
	
	/**
	 * @var string $endereco
	 * @return UsuarioParticularEntity
	 */
	public function setEndereco($endereco)
	{
		$this->endereco = $endereco;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getEndereco()
	{
		return $this->endereco;
	}
	
	/**
	 * @var string $bairro
	 * @return UsuarioParticularEntity
	 */
	public function setBairro($bairro)
	{
		$this->bairro = $bairro;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getBairro()
	{
		return $this->bairro;
	}
	
	/**
	 * @var string $complemento
	 * @return UsuarioParticularEntity
	 */
	public function setComplemento($complemento)
	{
		$this->complemento = $complemento;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getComplemento()
	{
		return $this->complemento;
	}
	
	/**
	 * @var string $cpf
	 * @return UsuarioParticularEntity
	 */
	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCpf()
	{
		return $this->cpf;
	}
	
	/**
	 * @var int $dddCelular
	 * @return UsuarioParticularEntity
	 */
	public function setDddCelular($dddCelular)
	{
		$this->dddCelular = $dddCelular;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getDddCelular()
	{
		return $this->dddCelular;
	}
	
	/**
	 * @var int $celular
	 * @return UsuarioParticularEntity
	 */
	public function setCelular($celular)
	{
		$this->celular = $celular;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getCelular()
	{
		return $this->celular;
	}
	
	/**
	 * @var int $dddTelefone
	 * @return UsuarioParticularEntity
	 */
	public function setDddTelefone($dddTelefone)
	{
		$this->DddTelefone = $dddTelefone;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getDddTelefone()
	{
		return $this->dddTelefone;
	}
	
	/**
	 * @var int $telefone
	 * @return UsuarioParticularEntity
	 */
	public function setTelefone($telefone)
	{
		$this->telefone = $telefone;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getTelefone()
	{
		return $this->telefone;
	}
	
	/**
	 * @var DateTime $dataCadastro
	 * @return UsuarioParticularEntity
	 */
	public function setDataCadastro($dataCadastro)
	{
		$this->dataCadastro = $dataCadastro;
		return $this;
	}
	
	/**
	 * @return DateTime
	 */
	public function getDataCadastro()
	{
		return $this->dataCadastro;
	}
	
	/**
	 * @var DateTime $dataModificacao
	 * @return UsuarioParticularEntity
	 */
	public function setDataModificacao($dataModificacao)
	{
		$this->dataModificacao = $dataModificacao;
		return $this;
	}
	
	/**
	 * @return DateTime
	 */
	public function getDataModificacao()
	{
		return $this->dataModificacao;
	}
		
	/**
	 * @var bool $emailConfirmado
	 * @return UsuarioParticularEntity
	 */
	public function setEmailConfirmado($emailConfirmado)
	{
		$this->emailConfirmado = $emailConfirmado;
		return $this;
	}
	
	/**
	 * @return bool
	 */
	public function getEmailConfirmado()
	{
		return $this->emailConfirmado;
	}
	
	/**
	 * @var string $codConfirmacao
	 * @return UsuarioParticularEntity
	 */
	public function setCodConfirmacao($codConfirmacao)
	{
		$this->codConfirmacao = $codConfirmacao;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCodConfirmacao()
	{
		return $this->codConfirmacao;
	}
	
	/**
	 * @var bool $contaHabilitada
	 * @return UsuarioParticularEntity
	 */
	public function setContaHabilitada($contaHabilitada)
	{
		$this->contaHabilitada = $contaHabilitada;
		return $this;
	}
	
	/**
	 * @return bool
	 */
	public function getContaHabilitada()
	{
		return $this->contaHabilitada;
	}
	
	/**
	 * @var string $codResetSenha
	 * @return UsuarioParticularEntity
	 */
	public function setCodResetSenha($codResetSenha)
	{
		$this->codResetSenha = $codResetSenha;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCodResetSenha()
	{
		return $this->codResetSenha;
	}
	
	/**
	 * @var DateTime $expResetSenha
	 * @return UsuarioParticularEntity
	 */
	public function setExpResetSenha($expResetSenha)
	{
		$this->expResetSenha = $expResetSenha;
		return $this;
	}
	
	/**
	 * @return DateTime
	 */
	public function getExpResetSenha()
	{
		return $this->expResetSenha;
	}
}