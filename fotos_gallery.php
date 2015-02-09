<?php
/**
 * This is the template that displays all gallery pages.
 *
 * Template Name: Galería
 * @package WordPress
 * @subpackage Tema_NEA
 * @since Tema NEA 1.0
 */

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
				<?php 
				while ( have_posts() ) : the_post();
					$children = get_pages('child_of='.$post->ID);
					if (count($children)!=0) {// If it has children show index
						?><article id="post-<?php echo the_ID(); ?>" <?php echo post_class(); ?>>
						<? echo '<header class="entry-header">';
						echo '<h1 class="entry-title">'.the_title().'</h1>';
						echo '</header><!-- .entry-header -->';
						echo '<div class="entry-content">';
						$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'desc' ) );
						foreach( $mypages as $page ) { ?>
							<div id="album"><a href="<? echo get_permalink($page->ID); ?>">
								<?php 
								if (has_post_thumbnail($page->ID)){
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'thumbnail' );
									echo '<img src="'.$image[0].'" class="current"><br>';
								} else { 
									echo echo_first_image($page->ID).'<br>';
								}; ?>
								<? echo get_the_title($page->ID); ?></a></div>
						<?php };
						echo '</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->';
					} else { // If it is bottom page show content
						get_template_part( 'content', 'page' );
					};
				endwhile; // end of the loop. 
				
				?>
			</div><!-- #content -->
			<div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
		</div><!-- #primary -->

<?php get_footer(); ?>