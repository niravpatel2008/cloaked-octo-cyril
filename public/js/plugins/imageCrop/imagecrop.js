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
	addNewSelection: function(id,v) {
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

		if(id)
			this.$outline.data("t_id",id);

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
			}
		});
		this.$outline.on('dblclick',function(){
			var nid = $(this).attr('id').replace('outline-',"");
			delete $this.config.outlines[nid];
			$(this).remove();
		});
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
				$pos.push({x:$(v).css('left') ,y:$(v).css('top') ,w:$(v).width() ,h:$(v).height(), t_id:$(v).data('t_id') });
			}
		})
		return $pos;
	},
	setAllSelection: function() {
		$this = this;
		$(this.config.selections[0]).each(function(e,v){
			$this.addNewSelection(v.id,JSON.parse(v.area));
		});
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