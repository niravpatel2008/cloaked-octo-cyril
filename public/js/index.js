var isAjaxLoad = false;
$(document).ready(function(){
	document.body.scrollTop = document.documentElement.scrollTop = 0; // Always starts page load from Top
	$('#hdnCurrPage').val('1');
	getStamps('');

	$(window).scroll(function () {
		var curPage = $('#hdnCurrPage').val();
		if((curPage * $('#hdnRecLimit').val()) <= $('#hdnTotalRec').val())
		{
			//if (isAjaxLoad == false && $(document).height() <= $(window).scrollTop() + $(window).height()) {
			if (isAjaxLoad == false && $(window).scrollTop() >= ($(document).height() - $(window).height())*0.75) {
				// Lazy Load made ajax call when 75% scroll has been made 
				curPage++;
				$('#hdnCurrPage').val(curPage);
				getStamps(curPage);
			}
		}
		else
			return;
    });
	
});

function getStamps(curPage)
{
	var url =  base_url()+'welcome/index';
	
	var page ;
	if($('#hdnCurrPage').length > 0)
		page = $('#hdnCurrPage').val();
	else if(!isNaN(curPage)) 
		page = $.trim(curPage);

	var limit = $('#hdnRecLimit').val();
	
	var hdnTag = $('#hdnTag').val();
	var hdnUid = $('#hdnSearchUid').val();
	var searchKeyword = $('#searchKeyword').val();
	var from = 'user';
	if($('#pageFrom').length > 0 )
		from = $('#pageFrom').val();

	var data =  {from:from,getStamps:1,page:page,limit:limit,hdnTag:hdnTag,searchKeyword:searchKeyword,hdnUid:hdnUid};
	isAjaxLoad = true;
	$.post(url,data,function(e){
		if(e != ""){
			isAjaxLoad = false;
			if(from == 'userdashboard')
				displayUserStamps(e);
			else
				displayStamps(e);
		}else{
			$('#mainStampContainer').html('<div class="col-lg-12"><div class="alert alert-danger">Ooops!! No Record Found</div></div>');
			isAjaxLoad = false;
			return false;
		}
	});
}

function displayStamps(result)
{
	//alert(1);
	var flag = false;
	var stampHtml = '';
	resultJson = JSON.parse(result);
	var imgPath = base_url()+"uploads/stamp/";
	var totalRec = resultJson.total;
	result = resultJson.data;
	$('#hdnTotalRec').val(totalRec);
	$.each(result, function(index,element)
	{ 
		//favClass = (element.is_fav)?'unfavme':'favme';
		//commanAttr = " st_url='"+element.url+"' st_title='"+element.name+"' st_image='"+element.photo+"' st_summary='"+element.name+"' ";
		
		if(index != 'totalRecordsCount')
		{
			stampHtml += '<div id="stampBlock" class="trick-card col-lg-3 col-md-6 col-sm-6 col-xs-12" style="">';
			stampHtml += '<div class="trick-card-inner js-goto-trick" data-slug="modelmap-jquerymap-style">';
				stampHtml += '<a class="trick-card-title" href="'+base_url()+'stampDetail/viewDetail/?tid='+element.t_id+'" style="text-align:center;word-wrap:break-word;">';
					//stampHtml += 'Title Goes Here';
					stampHtml += element.t_name;
				stampHtml += '</a>';
				stampHtml += '<div style="text-align: center; margin-bottom: 15px;"><img src="'+imgPath+element.stamp_photo+'"  alt="'+element.t_name+'" title="'+element.t_name+'" height="180" width="200"/></div>';
				stampHtml += '<div class="trick-card-stats trick-card-by" style="text-align:center;border-top-style:solid;border-top-width:1px;border-top-color:#eee;">Posted by <b><a href="'+base_url()+'index/'+element.t_uid+'" id="" class="unameStamp" uid="'+element.t_uid+'">'+element.uname+'</a></b> From <b><a href="javascript:void(0);">'+element.t_ownercountry+'</a></b>';
				stampHtml += '</div>';
				stampHtml += '<div class="trick-card-stats clearfix" style="text-align:center;">';
					stampHtml += '<div class="trick-card-timeago">Posted On  '+element.t_modified_date;
					stampHtml += '</div>';
					/*stampHtml += '<div class="trick-card-stat-block"><span class="fa fa-eye"></span> 247</div>';
					stampHtml += '<div class="trick-card-stat-block text-center"><span class="fa fa-comment"></span> <a href="http://www.laravel-tricks.com/tricks/modelmap-jquerymap-style#disqus_thread" data-disqus-identifier="657" style="color: #777;">0</a></div>';
					stampHtml += '<div class="trick-card-stat-block text-right"><span class="fa fa-heart"></span> 1</div>';*/
				stampHtml += '</div>';
				stampHtml += '<div class="trick-card-tags clearfix">';
				$.each(element.t_tags, function(i,j){
					if(j)
					    stampHtml += '<a href="'+base_url()+'tags/'+j+'" class="tag" title="models">'+j+'</a>';
				});
				stampHtml += '</div>';
			stampHtml += '</div>';
		stampHtml += '</div>';
			//var grid = $('#search_results');
			//salvattore['append_elements'](grid[0], [$(article)[0]]);
			//dealCnt++;
		}
	});
	$('#mainStampContainer').append(stampHtml);
}
function displayUserStamps(result)
{
	//alert(1);
	var flag = false;
	var stampHtml = '';
	var resultJson = JSON.parse(result);
	var imgPath = base_url()+"uploads/stamp/";
	var totalRec = resultJson.total;
	result = resultJson.data;
	$('#hdnTotalRec').val(totalRec);
	$.each(result, function(index,element)
	{ 
		if(index != 'totalRecordsCount')
		{
			stampHtml += '<div id="stampBlock" class="trick-card col-lg-3 col-md-6 col-sm-6 col-xs-12" style="">';
			stampHtml += '<div class="trick-card-inner js-goto-trick" data-slug="modelmap-jquerymap-style">';
			
			stampHtml += '<a class="trick-card-title" href="'+base_url()+'stampDetail/viewDetail/?tid='+element.t_id+'" style="text-align:center;word-wrap:break-word;">';
			stampHtml += element.t_name+'</a>';
			
			stampHtml += '<div style="text-align: center; margin-bottom: 15px;"><img src="'+imgPath+element.stamp_photo+'" alt="'+element.t_name+'" title="'+element.t_name+'" height="180" width="200"/></div>';
			
			stampHtml += '<div class="trick-card-stats trick-card-by" style="text-align:center;border-top-style:solid;border-top-width:1px;border-top-color:#eee;">Country : <b><a href="javascript:void(0);">'+element.t_ownercountry+'</a></b></div>';

			stampHtml += '<div class="trick-card-stats trick-card-by" style="text-align:center;border-top-style:solid;border-top-width:1px;border-top-color:#eee;">Price : <b><a href="javascript:void(0);">'+element.t_price+'</a></b></div>';

			stampHtml += '<div class="trick-card-stats trick-card-by" style="text-align:center;border-top-style:solid;border-top-width:1px;border-top-color:#eee;">Stamp Year : <b><a href="javascript:void(0);">'+element.t_year+'</a></b></div>';
			
			stampHtml += '<div class="trick-card-stats clearfix" style="text-align:center;">';
			stampHtml += '<div class="trick-card-timeago">Posted On  '+element.t_modified_date+'</div></div>';

			stampHtml += '<div class="trick-card-tags clearfix">';
			$.each(element.t_tags, function(i,j){
				if(j)
					stampHtml += '<a href="'+base_url()+'tags/'+j+'" class="tag" title="tags" style="margin-bottom:2px;">'+j+'</a>';
			});
			stampHtml += '</div>';
			
			stampHtml += '<div id="divDelStamp" class="trick-card-tags clearfix"><a href="javascript:void(0);" class="delStamp" title="Delete Stamp" id="delStamp_'+element.t_id+'"><img style="height:50px;width:50px" src="'+public_path()+'images/delete-ico.png" alt="Delete"></a><a href="'+base_url()+'profile/addstamp/'+element.t_id+'" class="" title="Edit Stamp" id="delStamp_'+element.t_id+'"><img style="height:50px;width:50px" src="'+public_path()+'images/edit-ico.png" alt="Edit"></a></div>';
			stampHtml += '</div></div>';
		}
	});
	$('#mainStampContainer').append(stampHtml);
	
}
