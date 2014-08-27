<div id="footer">
  <div class="container">
    <p class="text-muted credit">Website built with <a href="http://laravel.com">Laravel</a> by <a target="_blank" href="http://twitter.com/">Stidges</a> &amp; <a target="_blank" href="http://twitter.com/">Maks Surguy</a> | <a href="#">About Us</a>
    <span class="pull-right">
        <a target="_blank" href="http://twitter.com/" title="Follow updates"><i class="fa fa-twitter fa-lg"></i></a>
        |
        <a target="_blank" href="https://facebook.com" title="Get the source of this site"><i class="fa fa-facebook fa-lg"></i></a>
    </span>
    </p>

  </div>
</div>

</body>
<script src="http://www.laravel-tricks.com/js/vendor/masonry.pkgd.min.js"></script>
<script>
$(function(){$container=$(".js-trick-container");$container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});$(".js-goto-trick a").click(function(e){e.stopPropagation()});$(".js-goto-trick").click(function(e){e.preventDefault();var t="http://www.laravel-tricks.com/tricks";var n=$(this).data("slug");window.location=t+"/"+n})})
</script>