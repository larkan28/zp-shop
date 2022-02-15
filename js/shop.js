window.onload = loadFunctions;

function loadFunctions () {
	var check_multi = document.getElementById("buy_multi");
	
	var check_pts_hm = document.getElementById("buy_ph");
	var check_pts_zm = document.getElementById("buy_pz");
	var check_pts_ap = document.getElementById("buy_ap");
	
	var select_tmulti = document.getElementById("sel_tmulti");
	var select_dmulti = document.getElementById("sel_dmulti");
	
	check_multi.checked = false;
	
	check_pts_hm.checked = false;
	check_pts_zm.checked = false;
	check_pts_ap.checked = false;
	
	select_tmulti.selectedIndex = 0;
	select_dmulti.selectedIndex = 0;
	
	checkPoints(check_pts_hm, 'points_hm');
	checkPoints(check_pts_hm, 'points_zm');
	checkPoints(check_pts_hm, 'points_ap');
	
	document.getElementById('pts_hm_1').checked = true;
	document.getElementById('pts_zm_1').checked = true;
	document.getElementById('pts_ap_1').checked = true;
	
	checkMulti(check_multi);
	calculateTotal();
}

function checkMulti (btn_obj) {
	var newval = !btn_obj.checked;
	
	document.getElementById("sel_tmulti").disabled = newval;
	document.getElementById("sel_dmulti").disabled = newval;
	
	calculateTotal();
}

function checkPoints (btn_obj, type) {
	var radios = document.getElementsByName(type);
	var newval = !btn_obj.checked;
	
    for (i = 0; i < radios.length; i++)
		radios[i].disabled = newval;
	
	calculateTotal();
}

function checkTypeMulti () {
	document.getElementById("sel_dmulti").selectedIndex = 0;
	calculateTotal();
}

function calculateTotal () {
	var total = 0;
	var items = "";
	
	var buy_multi = document.getElementById("buy_multi").checked;
	
	var buy_ph = document.getElementById("buy_ph").checked;
	var buy_pz = document.getElementById("buy_pz").checked;
	var buy_ap = document.getElementById("buy_ap").checked;
	
	if (buy_multi) {
		var type_multi = document.getElementById("sel_tmulti");
		var dura_multi = document.getElementById("sel_dmulti");
		
		switch (type_multi.selectedIndex) {
			case 0:
				switch (dura_multi.selectedIndex) {
					case 0:
						items += "x2 - 1 Mes";
						
						total += 80;
						break;
					case 1:
						items += "x2 - 2 Meses";
						
						total += 140;
						break;
					case 2:
						items += "x2 - 3 Meses";
						
						total += 220;
						break;
				}
				
				break;
			case 1:
				switch (dura_multi.selectedIndex) {
					case 0:
						items += "x3 - 1 Mes";
						
						total += 140;
						break;
					case 1:
						items += "x3 - 2 Meses";
						
						total += 270;
						break;
					case 2:
						items += "x3 - 3 Meses";
						
						total += 400;
						break;
				}
				
				break;
			case 2:
				switch (dura_multi.selectedIndex) {
					case 0:
						items += "x4 - 1 Mes";
						
						total += 220;
						break;
					case 1:
						items += "x4 - 2 Meses";
						
						total += 350;
						break;
					case 2:
						items += "x4 - 3 Meses";
					
						total += 480;
						break;
				}
				
				break;
			case 3:
				switch (dura_multi.selectedIndex) {
					case 0:
						items += "x5 - 1 Mes";
						
						total += 300;
						break;
					case 1:
						items += "x5 - 2 Meses";
						
						total += 430;
						break;
					case 2:
						items += "x5 - 3 Meses";
						
						total += 560;
						break;
				}
				
				break;
		}
	}
	
	if (buy_ph) {
		if (items)
			items += ", ";
		
		if (document.getElementById('pts_hm_1').checked) {
			items += "1.000 pH";
			total += 90;
		}
		else if (document.getElementById('pts_hm_2').checked) {
			items += "2.500 pH";
			total += 180;
		}
		else if (document.getElementById('pts_hm_3').checked) {
			items += "5.000 pH";
			total += 250;
		}
		else if (document.getElementById('pts_hm_4').checked) {
			items += "10.000 pH";
			total += 500;
		}
	}
	
	if (buy_pz) {
		if (items)
			items += ", ";
		
		if (document.getElementById('pts_zm_1').checked) {
			items += "1.000 pZ";
			total += 80;
		}
		else if (document.getElementById('pts_zm_2').checked) {
			items += "2.500 pZ";
			total += 150;
		}
		else if (document.getElementById('pts_zm_3').checked) {
			items += "5.000 pZ";
			total += 230;
		}
		else if (document.getElementById('pts_zm_4').checked) {
			items += "10.000 pZ";
			total += 480;
		}
	}
	
	if (buy_ap) {
		if (items)
			items += ", ";
	
		if (document.getElementById('pts_ap_1').checked) {
			items += "1 Ancient Point";
			total += 250;
		}
		else if (document.getElementById('pts_ap_2').checked) {
			items += "2 Ancient Points";
			total += 500;
		}
		else if (document.getElementById('pts_ap_3').checked) {
			items += "3 Ancient Points";
			total += 750;
		}
	}
	
	document.getElementById("idh_total").value = Math.round(total);
	document.getElementById("idh_items").value = items;
	
	document.getElementById("total").innerHTML = Math.round(total) + " ARS";
	document.getElementById("buy").disabled = (total <= 0);
}