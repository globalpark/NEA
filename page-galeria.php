<?php
/*
Template Name: Galeria
*/
?>

<?php get_header(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<div id="primary">

    <div id="content" role="main">
                                        
        <article class="page type-page status-publish hentry">
            <header class="entry-header">
                <h1 class="entry-title">Galería</h1>
            </header><!-- .entry-header -->
        </article>

        <div class="galeria-nav">
            <ul class="nav nav-pills nav-justified" role="tablist">
              <li class="active"><a href="#galeria-2010" role="tab" data-toggle="tab">2010</a></li>
              <li ><a href="#galeria-2011" role="tab" data-toggle="tab">2011</a></li>
              <li ><a href="#galeria-2012" role="tab" data-toggle="tab">2012</a></li>
              <li ><a href="#galeria-2013" role="tab" data-toggle="tab">2013</a></li>
              <li ><a href="#galeria-2014" role="tab" data-toggle="tab">2014</a></li>
              <li ><a href="#galeria-2015" role="tab" data-toggle="tab">2015</a></li>
            </ul>
        </div>

        <div id="galerias" class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="galeria-2010">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2010', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="galeria-2011">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2011', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="galeria-2012">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2012', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="galeria-2013">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2013', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="galeria-2014">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2014', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="galeria-2015">

                <!-- WP Query 2010 -->
                <?php $args = array( 'post_type' => 'galeria-2015', 'posts_per_page' => 20, 'order' => 'ASC' ); ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                
                <div class="galeria">
                    <?php the_post_thumbnail(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                                
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>

            </div>

        </div>

    </div><!-- .content -->

    <div id="sidebar"><?php if ( dynamic_sidebar('social_media') ) : else : endif; ?><div id="twitterborder"><a class="twitter-timeline" data-dnt=true href="https://twitter.com/ninosenalegria" data-widget-id="266375195898548226" height="600" width="250" lang="ES" data-link-color="red">Tweets de @Ninosenalegria</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div></div><!-- #sidebar -->
</div>

<?php get_footer(); ?>