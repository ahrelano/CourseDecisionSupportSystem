$(document).ready(function(){
	$('#se').click(function(){
		$.ajax({url:"div1.php", success: function(result){
			$('#instruction').html(result);		
		}});
		$('#se').remove();
	});
});


