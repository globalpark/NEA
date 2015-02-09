<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Escuelas
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Tema NEA 1.0
 */

get_header(); ?>

<script src="<?php bloginfo('template_directory'); ?>/js/mootools-core-1.4.5.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/mootools-more-1.4.0.1.js" type="text/javascript"></script>
<script charset="utf-8" src="https://github.com/rpflorence/Loop/raw/master/Source/Loop.js"></script>
<script charset="utf-8" src="https://github.com/rpflorence/SlideShow/raw/master/Source/SlideShow.js"></script>

<script>
	var navSlideShow;
	document.addEvent('domready', function(){
		
		new Fx.Accordion($('accordion'), '#ficha .handler_ficha', '#ficha .content_ficha', {display: -1, alwaysHide: true});

		// create a basic slideshow
		navSlideShow = new SlideShow('slideshow-content', {
			selector: 'li.cont', // only create slides out of the images
		});
		$$('.nav_prev').addEvent('click', function(event){
			event.stop();
			navSlideShow.show('previous', {transition: 'crossFade'});
		});
		$$('.nav_next').addEvent('click', function(event){
			event.stop();
			navSlideShow.show('next', {transition: 'crossFade'});
		});
	});
	
</script> 
<div id="primary">
				<?php 
				while ( have_posts() ) : the_post();
				$children = get_pages('child_of='.$post->ID);
				$class = (count($children)!=0)? "":"escuelas";
				echo '<div id="content" class="'.$class.'" role="main">';
					if (count($children)!=0) {// If it has children show index
						?><article id="post-<?php echo $post->ID; ?>" <?php echo post_class(); ?>>
						<? echo '<header class="entry-header">';
						echo '<h1 class="entry-title">'.the_title().'</h1>';
						echo '</header><!-- .entry-header -->';
						echo '<div class="entry-content">';
						echo '<div class="escuelas_menu_top">';
						wp_list_pages("title_li=&child_of=".$post->ID."&post_status=publish");
						echo '</div></div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->';
						$principal = true;
					} else { // If it is bottom page show content
						// FIRST THE SUBMENU ?>
						<div id="escuelas_menu_sub">
							<?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&post_status=publish"); ?>
						</div><!-- #escuelas_menu -->
						<?// NOW HERE GOES THE GALLERY
						$photos = aldenta_get_images('slider');
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</header><!-- .entry-header -->
							<? if ($photos) { ?>
							<div id='slideshow'>
								<ul id="slideshow-content" class='slideshow'>
										<?php $slides = count($photos);
										$i = 1;
										echo "<li class='cont'>";
										foreach ($photos as $photo) {
											echo $photo;
											if($i==$slides){
												echo "</li>";
											} else {
												echo (($i % 2) ? '' : '</li><li class="cont">');
											}
											$i++;
										} ?> 
								</ul>
								<span id="slideshow-menu"><a class="nav_prev" href="#"><</a><em>&nbsp;</em><em>&nbsp;</em><a class="nav_next" href="#">></a></span>
							</div>
							<?php }; ?>
							<div id="ficha" class="entry">
								<h1 class="handler_ficha">Ver Ficha Técnica</h1>
								<div class="content_ficha"><?php the_content(); ?></div>
							</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->
					<?php };
				endwhile; // end of the loop. ?>
			</div><!-- #content -->
			<?php if ($principal){?>
			<div id="sidebar"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div><!-- #sidebar -->
			<?}?>
		</div><!-- #primary -->

<?php get_footer(); ?>