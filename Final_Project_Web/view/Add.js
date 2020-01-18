
document.getElementById("Admin_Add").style.display = "none";
document.getElementById("Admin_edit").style.display = "none";

function AddForm() {
	document.getElementById("Admin_Add").style.display = "block";
	document.getElementById("Admin_edit").style.display = "none";
}
function EditForm() {

	document.getElementById("Admin_edit").style.display = "block";
	document.getElementById("Admin_Add").style.display = "none";
}
function order() {
	alert("The order has been successfully placed");

}




