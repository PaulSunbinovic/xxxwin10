$(function(){
	$('#usr_loginout').click(function(){
		$.ajax({
            'type': 'GET',
            'url':dologinout,
            'async':false,  
            'contentType': 'application/json',
            'data': prmts,
            'dataType': 'json',
            'success': function(data) {
            	if(data['rslt']==1){
            		window.location.reload();
            	}else{
            		alert(data['msg']);
            	}
             
                console.log("success");
            },
            'error':function() {
                console.log("error");
            }
        });
	})
})