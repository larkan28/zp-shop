function optionsPanel (id_opt) {
	var divs = document.getElementsByName("div_opts");
	
	for (i = 0; i < divs.length; i++) {
		if (divs[i].id == id_opt)
			divs[i].style.display = "block";
		else
			divs[i].style.display = "none";
	}
}