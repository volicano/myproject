function checkFuwuzhongxin(username){
	var flag = '';
	$.ajax({
		async:false,
		type:'POST',
		url:hosurl + '/userinfo/checkFuwuzhongxin/',
		data:'username='+username+'&YII_CSRF_TOKEN='+123,
		success:function(msg){
			flag = msg;
		}
	});
	return flag;
}
function checkTuijianren(usercode){
	var flag = '';
	$.ajax({
		async:false,
		type:'POST',
		url:hosurl + '/userinfo/checkTuijianren/',
		data:'username='+usercode+'&YII_CSRF_TOKEN='+123,
		success:function(msg){
			flag = msg;
		}
	});
	return flag;
}
function checkJiedianren(usercode){
	var flag = '';
	$.ajax({
		async:false,
		type:'POST',
		url:hosurl + '/userinfo/checkJiedianren/',
		data:'username='+usercode+'&YII_CSRF_TOKEN='+123,
		success:function(msg){
			flag = msg;
		}
	});
	return flag;
}
function checkUsercode(usercode){
	var flag = '';
	$.ajax({
		async:false,
		type:'POST',
		url:hosurl + '/userinfo/checkUsercode/',
		data:'username='+usercode+'&YII_CSRF_TOKEN='+123,
		success:function(msg){
			flag = msg;
		}
	});
	return flag;
}
