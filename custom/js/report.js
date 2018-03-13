$(document).ready(function() {
	// order date picker
	$("#startDate").datepicker();

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate").val();

		if(startDate == "") {
			if(startDate == "") {
				$("#startDate").closest('.form-group').addClass('has-error');
				$("#startDate").after('<p class="text-danger">La fecha inicial es requerida</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
					var mywindow = window.open('', 'Sistema de Gestión de Inventario', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Informe Consumo Minibar</title>');        
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		} // /else

		return false;
	});

});