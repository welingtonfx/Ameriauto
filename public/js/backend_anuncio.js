$(document).ready(function($) {
	var list_tipo_veiculo = 'idTipoVeiculo';
	var list_fabricante	  = 'idFabricante';
	var list_veiculo	  = 'idVeiculo';
	var initial_fabricante_html = $('#'+list_fabricante+' option:first').clone();
	var initial_veiculo_html = $('#'+list_veiculo +' option:first').clone();
	
	var baseUrl = window.location.protocol + "//" + window.location.host;
	
	// Carrega os Fabricantes ao escolher um Tipo de Veículo 
	$('#'+list_tipo_veiculo).change(function(e) {
		$('#'+list_fabricante).html(initial_fabricante_html);
		$('#'+list_veiculo).html(initial_veiculo_html);
		
		var tipoVeiculoValue = $(this).val();
		
		if(tipoVeiculoValue !== "")
		{
			$('#'+list_fabricante).html('<option value="">Carregando Fabricantes...</option>');
			
			$.ajax({
				url: baseUrl + '/anuncios/ajax/selectfabricante?idTipo='+tipoVeiculoValue,
				success: function(output) {
					var fabricantes = $.parseJSON(output);

					$('#'+list_fabricante).html(initial_fabricante_html);
					if (fabricantes !== "") 
					{
						$.each(fabricantes, function(idFabricante, nomeFabricante)
						{
							var option = $('<option>').attr('value', idFabricante).text(nomeFabricante);
							$('#'+ list_fabricante).append(option);
						});
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + " " + thrownError);
				}
			});
		}
	});
	
	// Carrega os Veículos ao selecionar um Fabricante
	$('#'+list_fabricante).change(function(e) {
		$('#'+list_veiculo).html(initial_veiculo_html);
		
		var tipoVeiculoValue = $('#'+list_tipo_veiculo).val();
		var fabricanteValue = $(this).val();
		
		if(fabricanteValue !== "")
		{
			$('#'+list_veiculo).html('<option value="">Carregando Veículos...</option>');
			
			$.ajax({
				url: baseUrl + '/anuncios/ajax/selectveiculo?idTipo='+tipoVeiculoValue+'&idFabricante='+fabricanteValue,
				success: function(output) {
					var veiculos = $.parseJSON(output);
					
					$('#' + list_veiculo).html(initial_veiculo_html);
					
					if(veiculos !=="")
					{
						$.each(veiculos, function(idVeiculo, nomeVeiculo) {
							var option = $('<option>').attr('value', idVeiculo).text(nomeVeiculo);
							$('#' + list_veiculo).append(option);
						});
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + " " + thrownError);
				}
			});
		}
	});
	
	// Máscara para Ano
	$('#ano').mask('0000', {clearifnotmatch: true});
	
	// Máscara para Placa
	$('#placa').mask('SSS-0000', {clearifnotmatch: true});
	
	// Máscara para Quilometragem
	$('#quilometragem').mask('0#####');
	
	// Máscara para Valor
	$('#valor').mask('000####');
	
	// Destaca a linha ao selecionar a foto para deleção
	$('.file-upload-row > div:last-child').on('click', 'input:checkbox', function() {

		if($(this).is(':checked')) 
		{
			$(this).closest('.file-upload-row').addClass('delete-row-highlight');			
		}
		else 
		{
			$(this).closest('.file-upload-row').removeClass('delete-row-highlight');			
		}
	});
	
});