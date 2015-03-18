<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Escuelas-1
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
    if (count($children)!=0) {
  ?>

      <article id="post-<?php echo $post->ID; ?>">
  <?php
    }
  ?>
  <p><?php the_title(); ?></p>
  <?php endwhile; ?>
</div><!-- #primary -->

<?php get_footer(); ?>