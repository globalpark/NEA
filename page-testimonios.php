<?php
/*
Template Name: Testimonios
*/
?>

<?php get_header(); ?>

<div id="primary">

    <div id="content" role="main">
                                        
        <article class="page type-page status-publish hentry">
            <header class="entry-header">
                <h1 class="entry-title">Testimonios</h1>
            </header><!-- .entry-header -->
        </article>

    

        <!-- WP Query Testimonios -->
        <?php $args = array( 'post_type' => 'testimonio', 'posts_per_page' => 10 ); ?>
        <?php $the_query = new WP_Query($args); ?>
        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'Marca', true);
        $thumb_url = $thumb_url_array[0];
        ?>

        <div id="testimonios">
            <div class="testimonio">
                <p><?php the_content(); ?></p>
                <h2><?php the_title(); ?></h2>
            </div>
        </div>
                        
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>

    </div><!-- .content -->

    <div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
</div>

<?php get_footer(); ?>