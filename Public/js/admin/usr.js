$(function(){
	//login
	//#####################
	$('#login').click(function(){

		//参数
		var usrnm=$('#usrnm');var usrpw=$('#usrpw');

		//验空
		if(isempty(usrnm)){
			alert('用户名不能为空');return;
		}
		if(isempty(usrpw)){
			alert('密码不能为空');return;
		}
		var rmb=$("input[name=rmb]");
		if($('#rmb').attr('checked')=='checked'){
			rmb.val('y');
		}else{
			rmb.val('n');
		}

		var prmts=$(this).parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		
		$.ajax({
            'type': 'GET',
            'url': dologin,
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
	//#################
	
})