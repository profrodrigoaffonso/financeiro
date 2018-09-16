$(function(){
	$("#date-payment").datepicker({ dateFormat: 'dd/mm/yy' });

	$( "form" ).on( "submit", function( event ) {
		$("#inserir").attr("disabled","disabled");
	});
});