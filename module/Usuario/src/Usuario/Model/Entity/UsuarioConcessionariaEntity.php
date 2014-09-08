<?php
namespace Anuncio\Model\Entity;

class UsuarioConcessionariaEntity
{
	/**
	 * @var int
	 */
	protected $idUsuarioConcessionaria;
	
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
	protected $nomeUrl;

	/**
	 * @var string
	 */	
	protected $nomeConcessionaria;
	
	/**
	 * @var string
	 */	
	protected $nomeResponsavel;
	
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
	protected $cnpj;
	
	/**
	 * @var int
	 */	
	protected $dddTelefone1;
	
	/**
	 * @var int
	 */	
	protected $telefone1;
	
	/**
	 * @var int
	 */	
	protected $dddTelefone2;
	
	/**
	 * @var int
	 */	
	protected $telefone2;
	
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
	 * @var string
	 */	
	protected $fotoFachada;
	
	/**
	 * @var string
	 */	
	protected $fotoLogotipo;
	
	/**
	 * @var int $idUsuarioConcessionaria
	 * @return UsuarioConcessionariaEntity
	 */
	public function setIdUsuarioConcessionaria($idUsuarioConcessionaria)
	{
		$this->idUsuarioConcessionaria = $idUsuarioConcessionaria;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getidUsuarioConcessionaria()
	{
		return $this->idUsuarioConcessionaria;
	}
	
	/**
	 * @var UsuarioEntity $idUsuario
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
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
	 * @var string $nomeUrl
	 * @return UsuarioConcessionariaEntity
	 */
	public function setNomeUrl($nomeUrl)
	{
		$this->nomeUrl = $nomeUrl;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getNomeUrl()
	{
		return $this->nomeUrl;
	}
	
	/**
	 * @var string $nomeConcessionaria
	 * @return UsuarioConcessionariaEntity
	 */
	public function setNomeConcessionaria($nomeConcessionaria)
	{
		$this->NomeConcessionaria = $nomeConcessionaria;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getNomeConcessionaria()
	{
		return $this->nomeConcessionaria;
	}
	
	/**
	 * @var string $nomeResponsavel
	 * @return UsuarioConcessionariaEntity
	 */
	public function setNomeResponsavel($NomeResponsavel)
	{
		$this->NomeResponsavel = $NomeResponsavel;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getNomeResponsavel()
	{
		return $this->NomeResponsavel;
	}
	
	/**
	 * @var string $endereco
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
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
	 * @var string $cnpj
	 * @return UsuarioConcessionariaEntity
	 */
	public function setCnpj($cnpj)
	{
		$this->cnpj = $cnpj;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCnpj()
	{
		return $this->cnpj;
	}
	
	/**
	 * @var int $dddTelefone1
	 * @return UsuarioConcessionariaEntity
	 */
	public function setDddTelefone1($dddTelefone1)
	{
		$this->dddTelefone1 = $dddTelefone1;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getDddTelefone1()
	{
		return $this->dddTelefone1;
	}
	
	/**
	 * @var int $telefone1
	 * @return UsuarioConcessionariaEntity
	 */
	public function setTelefone1($telefone1)
	{
		$this->telefone1 = $telefone1;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getTelefone1()
	{
		return $this->telefone1;
	}
	
	/**
	 * @var int $dddTelefone2
	 * @return UsuarioConcessionariaEntity
	 */
	public function setDddTelefone2($dddTelefone2)
	{
		$this->dddTelefone2 = $dddTelefone2;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getDddTelefone2()
	{
		return $this->dddTelefone2;
	}
	
	/**
	 * @var int $telefone2
	 * @return UsuarioConcessionariaEntity
	 */
	public function setTelefone2($telefone2)
	{
		$this->telefone2 = $telefone2;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getTelefone2()
	{
		return $this->telefone2;
	}
	
	/**
	 * @var DateTime $dataCadastro
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
	 */
	public function setDataModificacao($dataModificacao)
	{
		$this->DataModificacao = $dataModificacao;
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
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
	 */
	public function setcontaHabilitada($contaHabilitada)
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
	 * @return UsuarioConcessionariaEntity
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
	 * @return UsuarioConcessionariaEntity
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
	
	/**
	 * @var string $fotoFachada
	 * @return UsuarioConcessionariaEntity
	 */
	public function setFotoFachada($fotoFachada)
	{
		$this->fotoFachada = $fotoFachada;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getFotoFachada()
	{
		return $this->fotoFachada;
	}
	
	/**
	 * @var string $fotoLogotipo
	 * @return UsuarioConcessionariaEntity
	 */
	public function setFotoLogotipo($fotoLogotipo)
	{
		$this->fotoLogotipo = $fotoLogotipo;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getFotoLogotipo()
	{
		return $this->fotoLogotipo;
	}
}