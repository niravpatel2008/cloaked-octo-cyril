(function(window, $){
  var imageCrop = function($image, options){
      this.$image = $($image);
      this.options = options;
	  this.$outline = "";
    };

  imageCrop.prototype = {
    defaults: {
     minSelect : [50, 50],
	 outlines : [],
     count:0
    },
    init: function() {
			this.config = $.extend({}, this.defaults, this.options);
			var $holder = $('<div id="img-container" />')
					.css({
						position : 'relative'
					})
					.width(this.$image.width())
					.height(this.$image.height());

			this.$image.wrap($holder)
				.css({
					position : 'absolute'
				});
			$this = this;
			this.$image.mousedown(function(event){$this.setSelection($this,event)});

			if (typeof(this.config.selections) != "undefined")
			{
				this.setAllSelection(this);
			}
			return this;
    },
	getElementOffset: function(object) {
		var offset = $(object).offset();

		return [offset.left, offset.top];
	},
	getMousePosition: function(event) {
		var imageOffset = this.getElementOffset(this.$image);

		var x = event.pageX - imageOffset[0],
			y = event.pageY - imageOffset[1];

		x = (x < 0) ? 0 : (x > this.$image.width()) ? this.$image.width() : x;
		y = (y < 0) ? 0 : (y > this.$image.height()) ? this.$image.height() : y;

		return [x, y];
	},
	addNewSelection: function(t_id,v) {
		$this = this;
		var id = this.config.count++;
		$(".image-crop-outline").css({borderColor:'#ffffff'});
		this.$outline = $('<div class="image-crop-outline" id="outline'+"-"+id+'"/>')
			.css({
				opacity : this.config.outlineOpacity,
				position : 'absolute',
				borderColor:'#99C8FF',
				width: (v)?v.w:this.config.minSelect[0],
				height: (v)?v.h:this.config.minSelect[1]
			})
			.insertAfter(this.$image);

		if(t_id)
			this.$outline.data("t_id",t_id);

		this.config.outlines[id]=this.$outline;
		//console.log($image);
		this.$outline.resizable({containment:"#img-container"}).draggable({containment:"#img-container"});
		this.$outline.on('click',function(){
			var cid = $this.$outline.attr('id').replace('outline-',"");
			var nid = $(this).attr('id').replace('outline-',"");
			if (cid != nid)				
			{
				$(".image-crop-outline").css({borderColor:'#ffffff'});
				$this.$outline = $this.config.outlines[nid];
				$this.$outline.css({borderColor:'#99C8FF'});
				$($this.$outline).popover('show');
			}
		});
		this.$outline.on('dblclick',function(){
			var nid = $(this).attr('id').replace('outline-',"");
			var t_id = $(this).data('t_id');
			if (typeof(t_id) != "undefined" && t_id != "")
			{
				$.ajax({
					type: 'post',
					url: admin_path()+'stamp/delete',
					data: 'id='+t_id,
					success: function (data) {
						if (data == "success") {
							$("#flash_msg").html(success_msg_box ('stamp deleted successfully.'));
						}else{
							$("#flash_msg").html(error_msg_box ('An error occurred while processing.'));
						}
					}
				});

			}			
			delete $this.config.outlines[nid];
			$(this).remove();
		});
		$this.popOverInit($this.$outline);
		if (v && v.x)
		{
			$this.$outline.css({
				cursor : 'all-scroll',
				display : 'block',
				left : v.x,
				top : v.y
			})
		}
	},
	setSelection: function($this,event) {
		$this.addNewSelection();
		event.preventDefault();
		event.stopPropagation();

		selectionOrigin = $this.getMousePosition(event);
		$this.$outline.css({
				cursor : 'all-scroll',
				display : 'block',
				left : selectionOrigin[0],
				top : selectionOrigin[1]
			})
	},
	getSelection: function() {
		var $pos = [];
		$.each(this.config.outlines,function(e,v){
			if (typeof(v) != "undefined")
			{
				$pos.push({x:$(v).css('left') ,y:$(v).css('top') ,w:$(v).width()+4 ,h:$(v).height()+4, t_id:$(v).data('t_id') });
			}
		})
		return $pos;
	},
	setAllSelection: function() {
		$this = this;
		$(this.config.selections[0]).each(function(e,v){
			$this.addNewSelection(v.id,JSON.parse(v.area));
		});
	},
	popOverInit: function($obj) {
		stampInfo = $($obj).data("stamp");
		tplHtml = this.popOverHtml(stampInfo);
		id = "#"+$obj.attr('id');
		tplTitle = "<div class='clearfix'>Stamp Info: <a href='javascript:void(0);' class='pull-right fa fa-times-circle' onclick='$(\""+id+"\").popover(\"hide\");' title='delete'></a><div>";
		options = {html:true,placement:"top",trigger:"manual",selector:false,title:tplTitle,content:tplHtml};
		//console.log($obj);
		$($obj).popover(options);
	},
	popOverHtml: function(stampInfo){
		CountryData = (typeof(stampInfo) != 'undefined')?stampInfo.CountryData:"";
		NameData = (typeof(stampInfo) != 'undefined')?stampInfo.CountryData:"";
		PriceData = (typeof(stampInfo) != 'undefined')?stampInfo.CountryData:"";
		YearData = (typeof(stampInfo) != 'undefined')?stampInfo.CountryData:"";

		Name = '<div class="form-group">';
		Name += '<input id="al_country" class="form-control" type="text" title="Name" value="'+NameData+'" name="al_country" placeholder="Name">';
		Name += '</div>';

		Price = '<div class="form-group">';
		Price += '<input id="al_country" class="form-control" type="text" title="Price" value="'+PriceData+'" name="al_country" placeholder="Price">';
		Price += '</div>';

		Year = '<div class="form-group">';
		Year += '<input id="al_country" class="form-control" type="text" title="Year" value="'+YearData+'" name="al_country" placeholder="Year">';
		Year += '</div>';

		Country = '<div class="form-group">';
		Country += '<input id="al_country" class="form-control" type="text" title="Country" value="'+CountryData+'" name="al_country" placeholder="Country">';
		Country += '</div>';

		Bio = '<div class="form-group">';
		Bio += '<textbox id="al_country" class="form-control" type="text" title="Bio" name="al_country" placeholder="Bio">'+CountryData+'</textbox>';
		Bio += '</div>';

		SubmitBtn = "<div class='form-group clearfix'>";
		SubmitBtn += "<button class='btn btn-primary pull-left' type='submit'><i class=' fa fa-save'></i></button>";
		SubmitBtn += "<button class='btn btn-primary pull-right'><i class=' fa fa-trash-o'></i></button>";
		SubmitBtn += '</div>';

		html = "<div class='col-md-12'>";
		html += Name;
		html += Price;
		html += Year;
		html += Country;
		html += Bio;
		html += SubmitBtn;
		html += "</div>";

		return html;
	}
	 
  }

  imageCrop.defaults = imageCrop.prototype.defaults;

  $.fn.imageCrop = function(options) {
	return this.each(function() {
			var currentObject = this,
			image = new Image();
			image.onload = function() {
				currentObject.crop = new imageCrop(currentObject, options).init();
			};
			image.src = currentObject.src;
		});
	  };

  window.imageCrop = imageCrop;
})(window, jQuery);