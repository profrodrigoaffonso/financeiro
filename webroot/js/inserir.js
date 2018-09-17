$(function(){
	$("#date-payment").datepicker({ dateFormat: 'dd/mm/yy' });
	$('#value').mask('0000,00', {reverse: true});
	$('#hour-payment').mask('00:00', {reverse: true});

	$( "form" ).on( "submit", function( event ) {
		$("#inserir").attr("disabled","disabled");
	});
});