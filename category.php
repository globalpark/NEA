<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Tema NEA 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title border"><?php
						printf( __( '%s', 'tema_nea' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php tema_nea_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="blog-post">
						<?php if(has_post_thumbnail()) { ?>
							<div class="image">
								<?php the_post_thumbnail(); ?>
							</div>
							<div class="content">
								<h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
								<?php the_content(); ?>
							</div>
						<?php } else { ?>
							<div class="content full">
								<h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
								<?php the_content(); ?>
							</div>
						<?php } ?>
					</div>

				<?php endwhile; ?>

				<?php /* tema_nea_content_nav( 'nav-below' ); */ ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'tema_nea' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tema_nea' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<div id="sidebar">
<?php if ( dynamic_sidebar('social_media') ) : else : endif; ?>
<?php
	$args = array('title_li' => __( '' ));
?>
<div id="twitterborder" class="category-box">
	<h1>Categorías</h1>
	<?php wp_list_categories($args); ?>
</div>
<div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
<?php get_footer(); ?>
