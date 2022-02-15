window.onload = loadFunctions;

function loadFunctions () {
	var val_delete = getUrlParam('delete', 'no');
	var val_info = getUrlParam('info', 'no');
	var val_pay = getUrlParam('pay', 'no');
	
	document.getElementById("show_delete").checked = (val_delete == "yes");
	document.getElementById("show_info").checked = (val_info == "yes");
	document.getElementById("show_pay").checked = (val_pay == "yes");
}

function changeVars () {
	var check_delete = document.getElementById("show_delete");
	var check_info = document.getElementById("show_info");
	var check_pay = document.getElementById("show_pay");
	
	window.location.replace("http://sunrise-community.com/admincp/panel.php?delete=" 
		+ (check_delete.checked ? "yes" : "no") + "&info="
		+ (check_info.checked ? "yes" : "no") + "&pay="
		+ (check_pay.checked ? "yes" : "no"));
}

function getUrlVars () {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
	
    return vars;
}

function getUrlParam (parameter, defaultvalue){
    var urlparameter = defaultvalue;
	
    if (window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
	}
		
    return urlparameter;
}
