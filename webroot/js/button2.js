$(document).ready(function(){
	$('#su').click(function(){
		$.ajax({url:"div2.php", success: function(result){
			$('#instruction').html(result);		
		}});
	});
});


