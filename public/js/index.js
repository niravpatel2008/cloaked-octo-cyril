$(document).ready(function(){
	getStamps();
});

function getStamps()
{
	var url =  base_url()+'welcome/index';
	var data =  {from:"user",getStamps:1};
	$.post(url,data,function(e){
		if(e != ""){
			displayStamps(e);
		}else{
			alert("Please Try again later");
			return false;
		}
	});

}

function displayStamps(result)
{
	//alert(1);
	var flag = false;
	var stampHtml = '';
	result = JSON.parse(result);
	var imgPath = base_url()+"uploads/stamp/";
	var totalRec = result.totalRecordsCount;
	$.each(result, function(index,element)
	{ 
		//favClass = (element.is_fav)?'unfavme':'favme';
		//commanAttr = " st_url='"+element.url+"' st_title='"+element.name+"' st_image='"+element.photo+"' st_summary='"+element.name+"' ";
		
		if(index != 'totalRecordsCount')
		{
			stampHtml += '<div id="stampBlock" href="#" class="trick-card col-lg-4 col-md-6 col-sm-6 col-xs-12" style="">';
			stampHtml += '<div class="trick-card-inner js-goto-trick" data-slug="modelmap-jquerymap-style">';
				stampHtml += '<a class="trick-card-title" href="#" style="text-align:center;">';
					//stampHtml += 'Title Goes Here';
					stampHtml += element.t_name;
				stampHtml += '</a>';
				stampHtml += '<div style="text-align: center; margin-bottom: 15px;"><img src="'+imgPath+element.stamp_photo+'" alt="'+element.t_name+'" title="'+element.t_name+'" height="180" width="200"/></div>';
				stampHtml += '<div class="trick-card-stats trick-card-by" style="text-align:center;border-top-style:solid;border-top-width:1px;border-top-color:#eee;">Posted by <b><a href="#">'+element.uname+'</a></b> From <b><a href="#">'+element.t_ownercountry+'</a></b>';
				stampHtml += '</div>';
				stampHtml += '<div class="trick-card-stats clearfix" style="text-align:center;">';
					stampHtml += '<div class="trick-card-timeago">Posted On  '+element.t_modified_date;
					stampHtml += '</div>';
					/*stampHtml += '<div class="trick-card-stat-block"><span class="fa fa-eye"></span> 247</div>';
					stampHtml += '<div class="trick-card-stat-block text-center"><span class="fa fa-comment"></span> <a href="http://www.laravel-tricks.com/tricks/modelmap-jquerymap-style#disqus_thread" data-disqus-identifier="657" style="color: #777;">0</a></div>';
					stampHtml += '<div class="trick-card-stat-block text-right"><span class="fa fa-heart"></span> 1</div>';*/
				stampHtml += '</div>';
				stampHtml += '<div class="trick-card-tags clearfix">';
				    stampHtml += '<a href="stampDetail/viewDetail/?tid='+element.t_id+'" class="tag" title="models">View Details</a>';
				stampHtml += '</div>';
			stampHtml += '</div>';
		stampHtml += '</div>';
			//var grid = $('#search_results');
			//salvattore['append_elements'](grid[0], [$(article)[0]]);
			//dealCnt++;
		}
	});
	$('#mainStampContainer').html(stampHtml);
}