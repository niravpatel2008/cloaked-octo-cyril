$(document).ready(function(){
	$("#u_birthdate").daterangepicker({singleDatePicker:true,format: 'MM/DD/YYYY',startDate: '01/01/1901'});
	$("#user_form").validationEngine();
});