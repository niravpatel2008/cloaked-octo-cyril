$(document).ready(function(){
	getStamps();
});

function getStamps()
{
	var url =  base_url()+'welcome/index';
	var data =  {from:"user",getStamps:1};
	$.post(url,data,function(e){
		if(e == 'success'){
			//location.reload();
		}else{
			alert("Please Try again later");
			return false;
		}
	});
}