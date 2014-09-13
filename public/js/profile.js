$(document).ready(function(){
$("#frmAddPhoto").on('submit', function (e) {
	
		if($('#profile_photo').val() == "")
		{
			e.preventDefault();
			alert("Please Upload Photo");
			return false;
		}
		if($('#imgUserPhoto').attr('imgname') != "nophoto.jpg")
			$('#hdnOldPhoto').val($('#imgUserPhoto').attr('imgname'));
		$('#frmAddPhoto').submit();
		alert('1');
		//var data =  $("#frmAddPhoto").serialize();console.log(data);return false;
		//data = new FormData($('#frmAddPhoto')[0]);
		/*$.post(url,data,function(e){
			if(e == 'success'){
				//location.reload();
				location.href=base_url()+'profile';
			}else{
				alert("Invalid Username or Password");
				return false;
			}
		});*/
	
	});
});
