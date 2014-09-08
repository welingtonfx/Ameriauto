<?php
namespace Anuncio\Form;

class AnuncioOpcionais
{
	public $opcionais = array();
	
	public function __construct()
	{
		$this->setOpcionais();
	}
	
	private function setOpcionais()
	{
		$this->opcionais['opcAlarme'] = "Alarme";
		$this->opcionais['opcCDPlayer'] = "CD Player";
		$this->opcionais['opcRadioBluetooth'] = "Radio Bluetooth";
		$this->opcionais['opcRadioMP3'] = "Radio MP3";
		$this->opcionais['opcTocaFitas'] = "Toca Fitas";
		$this->opcionais['opcABS'] = "ABS";
		$this->opcionais['opcControleEstabilidade'] = "Controle de Estabilidade";
		$this->opcionais['opcArQuente'] = "Ar Quente";
		$this->opcionais['opcArCondicionado'] = "Ar Condicionado";
		$this->opcionais['opcArDigital'] = "Ar Digital";
		$this->opcionais['opcAirbagsFrontais'] = "Airbags Frontais";
		$this->opcionais['opcAirbagsLaterais'] = "Airbags Laterais";
		$this->opcionais['opcAirbagsCortina'] = "Airbags Cortina";
		$this->opcionais['opcAirbagsJoelho'] = "Airbags Joelho";
		$this->opcionais['opcIsofix'] = "Isofix";
		$this->opcionais['opcHillHolder'] = "Hill Holder (Assistente Partida em Rampa)";
		$this->opcionais['opcDirecaoHidraulica'] = "Direção Hidráulica";
		$this->opcionais['opcDirecaoEletrica'] = "Direção Elétrica";
		$this->opcionais['opcCalotas'] = "Calotas";
		$this->opcionais['opcRodasLigaLeve'] = "Rodas Liga Leve";
		$this->opcionais['opcInsufilm'] = "Insufilm";
		$this->opcionais['opcDisco4Rodas'] = "Disco nas 4 Rodas";
		$this->opcionais['opcVidroEletricoFrontal'] = "Vidro Elétrico Frontal";
		$this->opcionais['opcVidroEletricoTraseiro'] = "Vidro Elétrico Traseiro";
		$this->opcionais['opcTravaEletrica'] = "Trava Elétrica";
		$this->opcionais['opcBancoCouro'] = "Banco de Couro";
		$this->opcionais['opcRetrovisoresEletricos'] = "Retrovisores Elétricos";
		$this->opcionais['opcRetrovisoresRebativeis'] = "Retrovisores Rebatíveis";
		$this->opcionais['opcRetrovisorEletrocromico'] = "Retrovisor Eletrocrômico";
		$this->opcionais['opcCambioAutomatizado'] = "Câmbio Automatizado";
		$this->opcionais['opcCambioAutomatico'] = "Câmbio Automático";
		$this->opcionais['opcCambioCVT'] = "Câmbio CVT";
		$this->opcionais['opcProtetorCarter'] = "Protetor de Cárter";
		$this->opcionais['opcFarolMilha'] = "Farol de Milha";
		$this->opcionais['opcFarolNeblina'] = "Farol de Neblina";
		$this->opcionais['opcFarolXenon'] = "Farol de Xenon";
		$this->opcionais['opcTetoSolar'] = "Teto Solar";
		$this->opcionais['opcPaddleShift'] = "Paddle Shift";
		$this->opcionais['opcComputadorBordo'] = "Computador de Bordo";
		$this->opcionais['opcControleSomVolante'] = "Controle de Som no Volante";
		$this->opcionais['opcVolanteRegulagemAltura'] = "Volante com Regulagem de Altura";
		$this->opcionais['opcVolanteRegulagemProfundidade'] = "Volante com Regulagem de Profundidade";
		$this->opcionais['opcVolanteRevestidoCouro'] = "Volante Revestido em Couro";
		$this->opcionais['opcParachoqueCorVeiculo'] = "Parachoque na Cor do Veículo";
		$this->opcionais['opcPainelDigital'] = "Painel Digital";
		$this->opcionais['opcPilotoAutomatico'] = "Piloto Automático";
		$this->opcionais['opcCentralMultimidia'] = "Central Multimídia";
		$this->opcionais['opcDVDPlayer'] = "DVD Player";
		$this->opcionais['opcBloqueioTracao'] = "Bloqueio de Tração";
		$this->opcionais['opcBau'] = "Baú";
		$this->opcionais['opcBlindado'] = "Blindado";
		$this->opcionais['opcSensorEstacionamentoTraseiro'] = "Sensor Estacionamento Traseiro";
		$this->opcionais['opcSensorEstacionamentoDianteiro'] = "Sensor Estacionamento Dianteiro";
		$this->opcionais['opcParkAssist'] = "Park Assist (Assistente de Estacionamento)";
		$this->opcionais['opcSensorChuva'] = "Sensor de Chuva";
		$this->opcionais['opcAerofolio'] = "Aerofolio";
		$this->opcionais['opcTracaoQuatroRodas'] = "Tração nas Quatro Rodas";
		$this->opcionais['opcBancoRegulagemAltura'] = "Banco com Regulagem de Altura";
	}
	
	public function getOpcionais()
	{
		return $this->opcionais;
	}	
}