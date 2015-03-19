<?php
/*
Template Name: Patrocinadores
*/
?>

<?php get_header(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script>

<div id="primary">

    <div id="content" role="main">
                                        
        <article class="page type-page status-publish hentry">
            <header class="entry-header">
                <h1 class="entry-title">Patrocinadores</h1>
            </header><!-- .entry-header -->
        </article>

    

        <!-- WP Query Patrocinadores -->
        <?php $args = array( 'post_type' => 'patrocinador', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
        <?php $the_query = new WP_Query($args); ?>
        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <div id="patrocinadores">
            <div class="patrocinador">
                <?php the_post_thumbnail( $size, $attr ); ?>
            </div>
        </div>
                        
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>

        <!-- WP Query Patrocinadores Slider -->
        <?php $args = array( 'post_type' => 'patrocinador-slider', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
        <?php $the_query = new WP_Query($args); ?>

        <div id="patrocinadores-slider" class="owl-carousel">

            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <div class="item">
                <p>
                    <?php the_post_thumbnail(); ?>
                </p>
            </div>
                            
            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>

        </div>

    </div><!-- .content -->

    <div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
</div>

<script>
    $(document).ready(function() {
      $("#patrocinadores-slider").owlCarousel({
        autoHeight : true,
        items: 3
      });
    });
</script>

<?php get_footer(); ?>