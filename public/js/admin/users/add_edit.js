$(document).ready(function(){
	$("#u_birthdate").daterangepicker({singleDatePicker:true,format: 'MM/DD/YYYY'});
	$("#user_form").validationEngine();
});