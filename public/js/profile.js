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
		
	});
});

$('#btnPost').bind('click',function(){
	if($('#txtBioStatus').val() == "")
		alert("Please Insert Something to Post");
	else
	{
		var url = base_url()+'profile/updateBio';
		var data = "bio="+$.trim($('#txtBioStatus').val());
	
		$.post(url,data,function(e){
			if(e == '1'){
				$('#divBio').html($('#txtBioStatus').val());
				$('#txtBioStatus').val('');
			}else{
				alert("Error occured during Updating Bio !! Please Try again");
				return false;
			}
		});		
	}
});


$('#birthdate').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d',
	autoClose:true
})
