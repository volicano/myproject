function selectAllChk(idname){
	//ȫѡcheckbox ��id���� (������Ϊidname��ȫѡ)
	var a = document.getElementsByTagName("input"); 
	for (var i=0; i<a.length; i++){
	   if (a[i].type == "checkbox" && a[i].name==idname ) a[i].checked =!a[i].checked; 
	}
}
function show_msg(msg){
	//��ʾ��Ϣ ���������ǰҪ���ã�
	/*
	<script type="text/javascript" src="../include/js/jquery.js"></script>
	<script type='text/javascript' src='../include/js/boxy/javascripts/jquery.boxy.js'></script>
	<link rel="stylesheet" href="../include/js/boxy/stylesheets/boxy.css" type="text/css" />
	*/
	var options;
	options = $.extend({title: "��ʾ��Ϣ"}, options || {});
	var dialog = new Boxy("<div ondblclick='Boxy.get(this).hide(); return false;'><p>"+ msg + ". <span style='color:#c0c0c0;'>˫���ر�</span></p></div>", options);
  	allDialogs.push(dialog);
	return false;
}
function getFckeditorText(editor_name){
	//��ȡfckeditor����
	var oEditor = FCKeditorAPI.GetInstance(editor_name) ; 
	returnValue = oEditor.GetXHTML(true);
	return returnValue; 
} 
