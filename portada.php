<?php
/**
 * The template for displaying the homepage.
 *
 * Template Name: Portada
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Tema NEA 1.0
 */

get_header();

while ( have_posts() ) : the_post();
$set = get_post_meta($post->ID);

if (has_post_thumbnail( $post->ID )){
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portada_crop' );
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$link_to = ($set[link_image][0]!="")? $set[link_image][0] : $image[0] ;
	$box = '<div id="zoom"><a href="'.$link_to.'" class="external" ><img src="'.$thumb[0].'"/></a></div>';
} else {
	$box = '<div id="ayuda"><a href="/?page_id=19"><big>¡Ayúdanos!</big><br>Dona aquí</a></div>';
};

?>

<script src="<?php bloginfo('template_directory'); ?>/js/mootools-core-1.4.5.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/mootools-more-1.4.0.1-assets.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/cerabox.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/cerabox.css" />
<script type="text/javascript">
window.addEvent('load', function() {
	$$('#zoom a').cerabox({
		animation: 'ease',
		loaderAtItem: true,
		clickToClose: true,
		displayTitle: false,
		displayOverlay: false,
		fullSize: true
	});
});
</script>
	<div id="primary" class="portada">
		<div id="links"><a href="/?page_id=8" class="bplink"><img src="<?php echo get_template_directory_uri(); ?>/images/banner_escuelas.jpg"></a><a href="?page_id=11" class="bplink"><img src="<?php echo get_template_directory_uri(); ?>/images/banner_programas.jpg"></a><a href="/?page_id=181" class="bplink"><img src="<?php echo get_template_directory_uri(); ?>/images/banner_fotos.jpg"></a></div>
		<div id="twitter"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="100%" width="450" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
		<?php echo $box; ?>
		<div id="video"><iframe width="450" height="100%" src="http://www.youtube.com/embed/<?php echo $set[video_id][0];?>" frameborder="0" allowfullscreen></iframe></div>
	</div><!-- #primary -->
<?php endwhile;
get_footer(); ?>

