var go_to_signin_page = function () {
	document.getElementById("bg_img_container").style.width = "79%";
	document.getElementById("login_page").style.visibility = "visible";
}

var close_window = function () {
	document.getElementById("login_page").style.visibility = "hidden";
	document.getElementById("bg_img_container").style.width = "100%";
}