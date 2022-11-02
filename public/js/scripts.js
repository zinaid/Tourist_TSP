/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
	document.getElementById("mySidebar").style.width = "250px";
	$(".opendugme").css("display", "none");
	$(".closebtn").css("display", "block");
}
/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
	document.getElementById("mySidebar").style.width = "0";
	$(".opendugme").css("display", "block");
	$(".closebtn").css("display", "none");
}
$(".pac_input_shower").click(function() {
	$("#pac-input").css("display", "inline-block");
	$(".pac_input_shower").css("display", "none");
	$(".pac_input_hider").css("display", "inline-block");
	$(".top_menu_adder").css("display", "inline-block");
});
$(".pac_input_hider").click(function() {
	$("#pac-input").css("display", "none");
	$(".pac_input_hider").css("display", "none");
	$(".pac_input_shower").css("display", "inline-block");
	$(".top_menu_adder").css("display", "none");
});

function openList() {
	document.getElementById("mySidebar_list").style.width = "240px";
	$(".opendugme_list").css("display", "none");
	$(".closebtn_list").css("display", "block");
}
/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeList() {
	document.getElementById("mySidebar_list").style.width = "0";
	$(".opendugme_list").css("display", "block");
	$(".closebtn_list").css("display", "none");
}