  <div id="footer">
  <!--recent comments start -->
  <div class="footer-recent-posts">
    <h4>Recent Posts</h4>
  	<?php query_posts('showposts=5'); ?>
	<ul>
	<?php while (have_posts()) : the_post(); ?>
	<li>
	<strong><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></strong><br />
	<small><?php the_time('m-d-Y') ?></small>
	</li>
	<?php endwhile;?>
	</ul>
  </div>
  <!--recent comments start -->

  <!--recent comments start -->
  <div class="footer-recent-comments">
    <?php include (TEMPLATEPATH . '/simple_recent_comments.php'); /* recent comments plugin by: www.g-loaded.eu */?>
	<?php if (function_exists('src_simple_recent_comments')) { src_simple_recent_comments(5, 60, '<h4>Recent Comments</h4>', ''); } ?>
  </div>
  <!--recent comments end -->
  
	<!--about text start -->
	<div class="footer-about">
		<?php include (TEMPLATEPATH . '/about_text.txt'); /* Open about_text.txt in the theme folder to edit this text */?>	
	</div>
	<!--about text end -->
	
  <hr class="clear" />
  </div><!--/footer -->
</div><!--/page -->

<!--credits start -->
<div id="credits">
<div class="alignleft"><a href="http://www.ndesign-studio.com/resources/wp-themes/">WP Theme</a> &amp; <a href="http://www.ndesign-studio.com/stock-icons/">Icons</a> by <a href="http://www.ndesign-studio.com">N.Design Studio</a></div> 
<div class="alignright"><a href="<?php bloginfo('rss2_url'); ?>" class="rss">Entries RSS</a> <a href="<?php bloginfo('comments_rss2_url'); ?>" class="rss">Comments RSS</a> <span class="loginout"><?php wp_loginout(); ?></span></div>
</div>
<!--credits end -->
<?php wp_footer(); ?>
</body>
</html>