$(document).ready(function(){
	$('form#notifications').click(function(){
			var id = $('#notification_id').val() ;
				$.ajax({
				url:"checker.php",
				method:"POST",
				data:{check:'chngNoti', id:id},
				success:function(data){

				}
				});
		})
		
	// setTimeout(function(){
		// window.location.reload(1);
	// }, 1000);	

	function update() {
		$.get("topbar.php", function(data) {
		$("a#alertsDropdown").html(data);
		window.setTimeout(update, 10000);
		});
	}
	
	//date picker enable for newEventPage	
	$( ".datepicker" ).datepicker({
		dateFormat: "dd-mm-yy",
		todayHighlight: true,
		changeMonth: true,
		changeYear: true,
		minDate: new Date()
	});

	
	$( "#createdatepicker" ).datepicker({
		dateFormat: "dd-mm-yy",
		todayHighlight: true,
		changeMonth: true,
		changeYear: true,
		minDate: new Date()
	});
		

		

  
  

   $('.fac').hide();
  
  $('#role').focusout(function(){
	var d =$(this).children("option:selected").val();
	if(d == 1){
		$('.fac').show();
	}else{
		$('.fac').hide();
	}
  });
  
  

  
  
  
  
  
  
  
  
  
  
  
	
});
