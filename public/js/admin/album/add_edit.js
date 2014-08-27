var $cropObj ;
$(document).ready(function(){
	$("#album_form").validationEngine();
	Dropzone.options.myAwesomeDropzone = {
	  maxFiles: 1,
	  accept: function(file, done) {
		console.log("uploaded");
		done();
	  },
	  init: function() {
		this.on("maxfilesexceeded", function(file){
			this.removeFile(file);
			alert("No more files please!");
		});
	  }
	};

	initCrop();

	//if(typeof($cropObj) !== 'undefined')
	//
	if ($("#my-awesome-dropzone").length > 0)
	{
		setTimeout(function(){
				var myDropzone = Dropzone.forElement("#my-awesome-dropzone");
				myDropzone.on("success", function(file, res) { 
					if (res.indexOf("Error:") === -1)
					{
						var file = JSON.parse(res);
						var html = "<li class='pull-left'>";
						html += "<img src='"+file.path+"' id='albumImg' class='newimgFull' imgid = '"+file.id+"'>";
						html += "<br>";
						html += "<center><a class='removeimage' link_id='"+file.id+"' href='#'><i class='fa fa-trash-o'></i></a><button class='btn btn-primary btn-flat' style='margin-left:14px;' id='btn_createstamp'>Create Stamp</button></center></li>";
						$("#img-container").append(html);
						$('#newimages').val($('#newimages').val() +"," +file.id);
						initCrop();
						doOrderImage();
						
					}
				});
		},1000)
	}
	
	/*$('#img-container').delegate("img",'click',function(){
		$('#img-container img').removeClass('selected');
		$(this).addClass('selected');
		$('#t_mainphoto').val($(this).attr('imgid'));
	});*/

	var mainimgid = $('#t_mainphoto').val();
	$('#img-container img[imgid="'+mainimgid+'"]').addClass('selected');

	/*$( ".t_tags").tagedit({
		//autocompleteURL: 'server/autocomplete.php',
	});*/

	//$( "#img-container" ).sortable({stop: function( event, ui ) {doOrderImage();}});

	$('#img-container').delegate(".removeimage","click",function(e){
		e.preventDefault();
		atag = $(this);
		link_id = $(atag).attr('link_id');

		var cnf = confirm("All Associated Stamps with this Album will be deleted. Do You want to Continue ?");
		if(cnf == true)
		{
			url = admin_path()+'stamp/delete',
			data = {id:link_id,from:'album',al_id:$('#al_id').val()};
			$.post(url,data,function(e){
				if (e == "success") {
					if ($('#t_mainphoto').val() == link_id)
					{
						$('#t_mainphoto').val("");
					}
					$(atag).closest('li.pull-left').remove();
					//$("#flash_msg").html(success_msg_box ('Image deleted successfully.'));
					alert("Images Deleted Successfully");
					//Dropzone.empty();
					location.reload();
				}else{
					$("#flash_msg").html(error_msg_box ('An error occurred while processing.'));
				}
			});
		}
	});
	
	$('#btn_createstamp').click(function(e){
		var cropJson = $cropObj[0].crop.getSelection();
		if(cropJson == null || cropJson == '')
		{
			alert("Create Stamp , You must have to crop image");return false;
		}
		var mainSrc = $('img#albumImg').attr('src');
		var al_id = $('#al_id').val();
		var albumName = $('#al_name').val();
		var price = $('#al_price').val();
		var country = $('#al_country').val();
		console.log(cropJson);
		e.preventDefault();
		url = admin_path()+'album/createStamp',
		data = {stampJson:cropJson,mainimg:mainSrc,al_id:al_id,al_name:albumName,price:price,country:country};
		$.post(url,data,function(e){
			if (e == "success") {
				alert("Stamps Created Successfully");
			}else
			{
				alert("Please try again later");
			}
		});
	});
});

function initCrop()
{
	var stampJson = '';
	stampJson = $('#t_dimension').val();console.log(stampJson);
	$cropObj = $('img#albumImg').imageCrop({
		overlayOpacity : 0.25,
//		selections : [{"x":"125px","y":"78px","w":50,"h":50},{"x":"114px","y":"169px","w":73,"h":131},{"x":"277px","y":"167px","w":126,"h":65},{"x":"335px","y":"275px","w":50,"h":50},{"x":"416px","y":"7px","w":50,"h":50}]
		selections : JSON.parse("["+stampJson+"]")
	});console.log($cropObj);
}