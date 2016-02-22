$(function () {
	//第一步所有的UL都关闭
	$('#tree').find('ul').hide();
	//然后开发第一lvl的ul
	$('#tree').children().show();
	$('#tree .oc').click(function(){
		
		if($(this).html()=='<i class="glyphicon glyphicon-plus"></i>'){
			$(this).html('<i class="glyphicon glyphicon-minus"></i>');
		}else if($(this).parent().children('UL').size()>0&&$(this).parent().children('UL')[0].style.display=="block"){//避免是第一层级且没有子嗣的
			$(this).html('<i class="glyphicon glyphicon-plus"></i>');
		}
		$(this).parent().children('ul').toggle();//直接这么写就等于在当前的click上点了同时在老爸的click上点了...类推
		
		
	})
})

function openall(){
	$('#tree').find('ul').show();
	if($('#tree .oc').html()=='<i class="glyphicon glyphicon-plus"></i>'){
		$('#tree .oc').html('<i class="glyphicon glyphicon-minus"></i>');
	}
}

function closeall(){

	//第一种方法：相当于刷新，比较讨巧
	//window.location.reload();
	//第二种方法：运用jquery神技
	var lsu=$('#tree').find('li');
	for(var i=0;i<lsu.length;i++){//alert($(lsu[i]).html());
		$(lsu[i]).has('ul').children('.oc').html('<i class="glyphicon glyphicon-plus"></i>');
	}
	//第一步所有的UL都关闭
	$('#tree').find('ul').hide();
	//然后开发第一lvl的ul
	$('#tree').children().show();
}


$(function () {
	//第一步所有的UL都关闭
	$('#treepos').find('ul').hide();
	//然后开发第一lvl的ul
	$('#treepos').children().show();
	$('#treepos .oc').click(function(){
		if($(this).html()=='<i class="glyphicon glyphicon-plus"></i>'){
			$(this).html('<i class="glyphicon glyphicon-minus"></i>');
		}else{
			$(this).html('<i class="glyphicon glyphicon-plus"></i>');
		}
		$(this).parent().children('ul').toggle();//直接这么写就等于在当前的click上点了同时在老爸的click上点了...类推
		
		
	})
})

function openallpos(){
	$('#treepos').find('ul').show();
}

function closeallpos(){
	//第一步所有的UL都关闭
	$('#treepos').find('ul').hide();
	//然后开发第一lvl的ul
	$('#treepos').children().show();
}

function disp(id){
	var mvid=$('input[name=mvid]');
	mvid.val(id);
	$('#alrt').trigger('click');
}


