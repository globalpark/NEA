<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Accordion
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Tema NEA 1.0
 */

get_header(); ?>
<script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/mootools-morefx-1.4.0.1.js" type="text/javascript"></script>
<script type="text/javascript">
	window.addEvent('domready', function(){
		var myAccord = new Fx.Accordion($$('#sections h2.titulo'), $$('.accordion'), {display: -1, alwaysHide: true});
	});
</script>
		<div id="primary">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
				
				<div class="sections" id="sections">
				<?php
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
					$sub = $num = 0;
					foreach( $mypages as $page ) {
						$content = $page->post_content;
						$children = get_pages('child_of='.$page->ID);
						if ( (count($children)!=0) && (!$content)) {// Check for children
							$sub ++;
							echo "<h1 class='head sub".$sub."'>".$page->post_title."</h1>";
						}
						if ( !$content ) {// Check for empty page
							continue;
						}
						$content = apply_filters( 'the_content', $content );
						$type = ($sub!=0)? "sub".$sub : "col".$num ;
					?>
						<h2 class="head titulo <?php echo $type ?>"><?php echo $page->post_title; ?></h2>
						<div class="accordion"><?php echo $content; ?></div>
					<?php
					$num = ($num==5)? 0 : $num+1;
					};
				?>
				</div><!-- #sections -->
			</div><!-- #content -->
			<div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
		</div><!-- #primary -->

<?php get_footer(); ?>