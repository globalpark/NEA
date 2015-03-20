<?php
/*
Template Name: Escuelas
*/
?>

<?php get_header(); ?>

<div id="primary">

    <div id="content" role="main">
                                        
        <article class="page type-page status-publish hentry">
            <header class="entry-header">
                <h1 class="entry-title">Escuelas</h1>
            </header><!-- .entry-header -->
        </article>

        <div id="escuelas">

            <!-- WP Query Testimonios -->
            <?php $args = array( 'post_type' => 'escuela', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
            <?php $the_query = new WP_Query($args); ?>
            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

            
            <div class="escuela">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
                            
            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>

        </div>

    </div><!-- .content -->

    <div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
</div>

<?php get_footer(); ?>