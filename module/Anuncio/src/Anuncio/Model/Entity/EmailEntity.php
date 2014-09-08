<?php
namespace Anuncio\Model\Entity;

class EmailEntity
{
	public $idEmail;
	public $idUsuario;
	public $idAnuncio;
	public $nomeRemetente;
	public $emailRemetente;
	public $mensagem;
	public $dataEnvio;
	public $ip;
}