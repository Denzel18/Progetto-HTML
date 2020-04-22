function doValidation(id, actionUrl, formName) {

	function showErrors(resp) {
		$("#" + id).parent().parent().find('.errors').html(' ');
		$("#" + id).parent().parent().find('.errors').html(getErrorHtml(resp[id]));
	}

	$.ajax({
		type : 'POST',
		url : actionUrl,
		data : $("#" + formName).serialize(),
		dataType : 'json',
		success : showErrors
	});
}

function getErrorHtml(formErrors) {
	if (( typeof (formErrors) === 'undefined') || (formErrors.length < 1))
		return;

	var out = '<ul>';
	for (errorKey in formErrors) {
		out += '<li>' + formErrors[errorKey] + '</li>';
	}
	out += '</ul>';
	return out;
}

function mostra() {
	document.getElementById("menu").style.left="0px";
}
function nascondi() {
	document.getElementById("menu").style.left="-200px";
}
function pippo() {
	if(document.getElementById("menu").style.left==="-200px"){
		document.getElementById("menu").style.left="0px";
		
	}else{
		document.getElementById("menu").style.left="-200px";
	}
}
window.onload = function() {
	document.getElementById('menu').style.left="-200px";
};
