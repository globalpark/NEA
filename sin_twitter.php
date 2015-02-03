<?php
/**
 * The template for displaying all pages.
 *
 * Igual que el general pero sin la columna lateral de twitter.
 *
 * Template Name: General Sin Twitter
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Tema NEA 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="notwitter" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>