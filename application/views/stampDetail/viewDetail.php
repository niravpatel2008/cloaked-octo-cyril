<div class="row">
	<div class="col-lg-9 col-md-8">
		<div class="content-box">
			<div class="trick-user">
				<div class="trick-user-image">
					<img class="user-avatar" src="<?=$details['stamp_photo'];?>">
				</div>
				<div class="trick-user-data">
					<h1 class="page-title">
						<?= $details['t_name'];?>
					</h1>
					<div>
						Posted by <b><a href="#"><?= $details['user_fullname'];?></a></b> - <?= $details['t_modified_date'];?>
					</div>
				</div>
			</div>
			
			<pre>
				<code class="php">
					<span class=""><?=$details['t_bio'];?></span>
				</code>
			</pre>

			<div>
				<h1 class="page-title">View All Stamps Here :-</h1>
				<?php
					foreach($details['all_photos'] as $k=>$v)
						echo '<img src="'.$v.'" class="stampDetail" alt="Stamp" title="Stamp-'.$details['t_name'].'"/>';
				?>
				
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-4">
		<div class="content-box">
			<b>Stats</b>
			<ul class="list-group trick-stats">
				<a data-liked="0" class="list-group-item js-like-trick" href="#">
					<span class="fa fa-heart "></span>24 likes
				</a>
				<li class="list-group-item">
					<span class="fa fa-eye"></span> 5106 views
				</li>
			</ul>
			<b>Categories</b>
			<ul class="nav nav-list push-down">
				<li>
					<a href="http://www.laravel-tricks.com/categories/eloquent">
						Eloquent
					</a>
				</li>
				<li>
					<a href="http://www.laravel-tricks.com/categories/form">
						Form
					</a>
				</li>
				<li>
					<a href="http://www.laravel-tricks.com/categories/views">
						Views
					</a>
				</li>
			</ul>
			<?php
				if(!empty($details['all_tags']))
				{ ?>
				<b>Tags</b>
				<ul class="nav nav-list push-down">
					<?php
						foreach($details['all_tags'] as $k => $v)
						{
							echo '<li><a href="'.base_url().'tags/'.$v['tag_name'].'">'.$v['tag_name'].'</a></li>';
						}
					?>
				</ul>
			<?php }?>
			<div class="clearfix">
				<a class="btn btn-sm btn-primary" data-toggle="tooltip" title="" href="http://www.laravel-tricks.com/tricks/create-your-own-anything-trickscom" data-original-title="Create your own Anything-tricks.com!">
					« Previous Trick
				</a>
				
				<a class="btn btn-sm btn-primary pull-right" data-toggle="tooltip" title="" href="http://www.laravel-tricks.com/tricks/using-eloquentfirstorcreate-to-prevent-duplicate-seeding" data-original-title="Using Eloquent::firstOrCreate() to prevent duplicate seeding">
						Next Trick »
				</a>
			</div>
		</div>
	</div>
</div>
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div id="disqus_thread"><iframe width="100%" frameborder="0" id="dsq-2" data-disqus-uid="2" allowtransparency="true" scrolling="no" tabindex="0" title="Disqus" style="width: 100% ! important; border: medium none ! important; overflow: hidden ! important; height: 2014px ! important;" src="http://disqus.com/embed/comments/?base=default&amp;disqus_version=520edd9f&amp;f=laraveltricks&amp;t_i=321&amp;t_u=http%3A%2F%2Fwww.laravel-tricks.com%2Ftricks%2Feasy-dropdowns-with-eloquents-lists-method&amp;t_d=%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20Easy%20dropdowns%20with%20Eloquent's%20Lists%20method%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20&amp;t_t=%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20Easy%20dropdowns%20with%20Eloquent's%20Lists%20method%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20&amp;s_o=default#2" horizontalscrolling="no" verticalscrolling="no"></iframe><iframe frameborder="0" id="dsq-indicator-north" data-disqus-uid="indicator-north" allowtransparency="true" scrolling="no" tabindex="0" title="Disqus" style="width: 848px ! important; border: medium none ! important; overflow: hidden ! important; top: 0px ! important; min-width: 848px ! important; max-width: 848px ! important; position: fixed ! important; z-index: 2147483646 ! important; height: 29px ! important; min-height: 29px ! important; max-height: 29px ! important; display: none ! important;"></iframe><iframe frameborder="0" id="dsq-indicator-south" data-disqus-uid="indicator-south" allowtransparency="true" scrolling="no" tabindex="0" title="Disqus" style="width: 848px ! important; border: medium none ! important; overflow: hidden ! important; bottom: 0px ! important; min-width: 848px ! important; max-width: 848px ! important; position: fixed ! important; z-index: 2147483646 ! important; height: 29px ! important; min-height: 29px ! important; max-height: 29px ! important; display: none ! important;"></iframe></div>
                        <script type="text/javascript">
                            /*var disqus_shortname = 'laraveltricks';
                            var disqus_identifier = '321';

                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();*/
                        </script>
                        <noscript>Please enable JavaScript to view the &lt;a href="http://disqus.com/?ref_noscript"&gt;comments powered by Disqus.&lt;/a&gt;</noscript>
                        
                    </div>
</div>